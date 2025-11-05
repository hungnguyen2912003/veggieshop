<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses = ShippingAddress::where('user_id', Auth::id())->get();
        return view('client.pages.account', compact('user', 'addresses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'ltn__name' => 'required|string|max:255',
            'ltn__phone' => 'nullable|string|max:15',
            'ltn__address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'ltn__name.required' => 'Vui lòng nhập tên của bạn.',
            'ltn__name.max' => 'Tên của bạn không được vượt quá 255 ký tự.',
            'ltn__phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'ltn__address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'avatar.image' => 'Tệp tải lên phải là một hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg, gif.',
            'avatar.max' => 'Kích thước ảnh đại diện không được vượt quá 2MB.',
        ]);

        $user = Auth::user();

        // Xử lý avatar mới
        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu có
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $file = $request->file('avatar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $avatarPath = $file->storeAs('uploads/users', $filename, 'public');
            $user->avatar = $avatarPath;
        }

        $user->name = $request->input('ltn__name');
        $user->phone_number = $request->input('ltn__phone');
        $user->address = $request->input('ltn__address');
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thông tin tài khoản thành công!',
            'avatar' => asset('storage/' . $user->avatar),
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'ltn__current-password' => 'required',
                'ltn__new-password' => 'required|min:6',
                'ltn__confirm-new-password' => 'required|same:ltn__new-password',
            ],
            [
                'ltn__current-password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
                'ltn__new-password.required' => 'Vui lòng nhập mật khẩu mới.',
                'ltn__new-password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
                'ltn__confirm-new-password.required' => 'Vui lòng xác nhận mật khẩu mới.',
                'ltn__confirm-new-password.same' => 'Xác nhận mật khẩu mới không khớp.',
            ]
        );

        $user = Auth::user();

        if (!Hash::check($request->input('ltn__current-password'), $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu hiện tại không đúng.',
            ], 400);
        }

        $user->update([
            'password' => Hash::make($request->input('ltn__new-password')),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đổi mật khẩu thành công!',
        ]);
    }

    public function addAddress(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
        ], [
            'full_name.required' => 'Vui lòng nhập tên đầy đủ.',
            'full_name.max' => 'Tên đầy đủ không được vượt quá 255 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'city.required' => 'Vui lòng nhập thành phố.',
            'city.max' => 'Tên thành phố không được vượt quá 100 ký tự.',
        ]);

        if ($request->has('default_address')) {
            ShippingAddress::where('user_id', Auth::id())->update(['default' => false]);
        }

        ShippingAddress::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'default' => $request->has('default_address') ? true : false,
        ]);

        toastr('Địa chỉ mới đã được thêm thành công!', 'success');
        return back();
    }

    public function updatePrimaryAddress(Request $request, $id)
    {
        $address = ShippingAddress::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        ShippingAddress::where('user_id', Auth::id())->update(['default' => false]);

        $address->default = true;
        $address->save();

        toastr('Địa chỉ đã được đặt làm mặc định!', 'success');
        return back();
    }

    public function deleteAddress($id)
    {
        $address = ShippingAddress::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $address->delete();

        toastr('Địa chỉ đã được xóa thành công!', 'success');
        return back();
    }
}
