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
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Please provide your name.',
            'email.required' => 'An email address is required for registration.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'A password is required to secure your account.',
            'password.min' => 'Your password must be at least 8 characters long.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        // Check if exist user with same email
        $userExists = User::where('email', $request->email)->first();
        if ($userExists) {
            if ($userExists->isPending()) {
                toastr()->error('Email already registered but not verified. Please check your email for verification link.');
                return redirect()->back()->withInput();
            } else {
                toastr()->error('Email already registered. Please use a different email.');
                return redirect()->back()->withInput();
            }
        }

        // Create token
        $token = Str::random(64);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'pending',
            'activation_token' => $token,
            'role_id' => 3, // Client role
        ]);

        Mail::to($user->email)->send(new ActivationMail($user, $token));

        toastr()->success('Registration successful! Please check your email to verify your account.');
        return redirect()->route('register.success', ['email' => $request->email]);
    }

    public function activate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            toastr()->error('Invalid activation token. Please check your email for the correct link.');
            return redirect()->route('login');
        }

        $user->status = 'active';
        $user->activation_token = null;
        $user->save();

        toastr()->success('Your account has been successfully activated.');
        return view('client.pages.activation-success', ['user' => $user]);
    }

    public function resendActivation(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        // Create token
        $token = Str::random(64);

        // Gán lại token mới
        $user->activation_token = $token;
        $user->save();

        // Chống spam resend (giới hạn 60 giây)
        $lastResend = session('last_resend_' . $user->email);
        if ($lastResend && now()->diffInSeconds($lastResend) < 60) {
            $remaining = 60 - now()->diffInSeconds($lastResend);
            toastr()->warning("Please wait {$remaining} seconds before resending.");
            return back();
        }

        // Cập nhật thời điểm gửi lại mail
        session(['last_resend_' . $user->email => now()]);

        // Gửi lại mail kích hoạt
        Mail::to($user->email)->send(new ActivationMail($user, $token));

        toastr()->success('A new activation email has been sent. Please check your inbox.');
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
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
        ]);

        // Kiểm tra tài khoản có status = active không
        $credentials['status'] = 'active';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (in_array(Auth::user()->role->name, ['customer'])) {
                toastr()->success('Login successful!');
                return redirect()->route('home');
            } else {
                Auth::logout();
                toastr()->error('Access denied. Please use a customer account to log in.');
                return redirect()->back()->withInput();
            }
        }

        // Nếu tới đây nghĩa là login thất bại
        toastr()->error('Invalid email or password. Please try again.');
        return redirect()->back()->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toastr()->success('You have been logged out successfully.');
        return redirect()->route('home');
    }
}
