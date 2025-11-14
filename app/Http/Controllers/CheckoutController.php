<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses = ShippingAddress::where('user_id', $user->id)->get();
        $defaultAddress = $addresses->where('default', 1)->first();
        if (is_null($addresses) || is_null($defaultAddress)) {
            toastr()->error('Vui lòng thêm địa chỉ giao hàng!');
            return redirect()->route('account.index');
        }

        $cartItems = CartItem::where(column: 'user_id', operator: $user->id)
            ->with(relations: 'product')
            ->get();

        $totalPrice = $cartItems->sum(
            callback: fn(CartItem $item): float|int => $item->quantity * $item->product->price
        );

        return view('client.pages.checkout', compact('addresses', 'defaultAddress', 'cartItems', 'totalPrice'));
    }

    public function getAddress(Request $request)
    {
        $address = ShippingAddress::where(column: 'id', operator: $request->address_id)
            ->where(column: 'user_id', operator: Auth::id())->first();

        if (!$address) {
            return response()->json(data: ['success' => false, 'message' => 'Không tìm thấy địa chỉ!']);
        }

        return response()->json([
            'success' => true,
            'data' => $address
        ]);
    }
}
