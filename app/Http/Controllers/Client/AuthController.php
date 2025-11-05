<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationMail;
use Illuminate\Support\Facades\Auth;

use function Flasher\Toastr\Prime\toastr;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('client.pages.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên của bạn.',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá 255 ký tự.',
            'email.unique' => 'Địa chỉ email này đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        // Kiểm tra xem email đã tồn tại chưa
        $userExists = User::where('email', $request->email)->first();
        if ($userExists) {
            if ($userExists->isPending()) {
                toastr()->error('Email này đã được đăng ký nhưng chưa được xác minh. Vui lòng kiểm tra email để kích hoạt tài khoản.');
                return redirect()->back()->withInput();
            } else {
                toastr()->error('Email này đã được đăng ký. Vui lòng sử dụng email khác.');
                return redirect()->back()->withInput();
            }
        }

        // Tạo mã token kích hoạt
        $token = Str::random(64);

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'pending',
            'activation_token' => $token,
            'role_id' => 3, // Khách hàng
        ]);

        // Gửi email kích hoạt
        Mail::to($user->email)->send(new ActivationMail($user, $token));

        toastr()->success('Đăng ký thành công! Vui lòng kiểm tra email để xác minh tài khoản của bạn.');
        return redirect()->route('register.success', ['email' => $request->email]);
    }

    public function activate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            toastr()->error('Mã kích hoạt không hợp lệ. Vui lòng kiểm tra lại liên kết trong email.');
            return redirect()->route('login');
        }

        $user->status = 'active';
        $user->activation_token = null;
        $user->save();

        toastr()->success('Tài khoản của bạn đã được kích hoạt thành công!');
        return view('client.pages.activation-success', ['user' => $user]);
    }

    public function resendActivation(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'email.exists' => 'Không tìm thấy tài khoản với địa chỉ email này.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Tạo token mới
        $token = Str::random(64);
        $user->activation_token = $token;
        $user->save();

        // Chống spam resend (giới hạn 60 giây)
        $lastResend = session('last_resend_' . $user->email);
        if ($lastResend && now()->diffInSeconds($lastResend) < 60) {
            $remaining = 60 - now()->diffInSeconds($lastResend);
            toastr()->warning("Vui lòng đợi {$remaining} giây trước khi gửi lại email kích hoạt.");
            return back();
        }

        // Cập nhật thời điểm gửi lại
        session(['last_resend_' . $user->email => now()]);

        // Gửi lại email kích hoạt
        Mail::to($user->email)->send(new ActivationMail($user, $token));

        toastr()->success('Email kích hoạt mới đã được gửi. Vui lòng kiểm tra hộp thư đến.');
        return back();
    }

    public function showSuccess(Request $request)
    {
        $email = $request->query('email');
        return view('client.pages.register-success', compact('email'));
    }

    public function showLoginForm()
    {
        return view('client.pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        // Chỉ cho phép đăng nhập nếu tài khoản đã kích hoạt
        $credentials['status'] = 'active';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (in_array(Auth::user()->role->name, ['customer'])) {
                toastr()->success('Đăng nhập thành công!');
                return redirect()->route('home');
            } else {
                Auth::logout();
                toastr()->error('Từ chối truy cập. Vui lòng sử dụng tài khoản khách hàng để đăng nhập.');
                return redirect()->back()->withInput();
            }
        }

        // Nếu đăng nhập thất bại
        toastr()->error('Email hoặc mật khẩu không đúng. Vui lòng thử lại.');
        return redirect()->back()->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toastr()->success('Bạn đã đăng xuất thành công.');
        return redirect()->route('home');
    }
}
