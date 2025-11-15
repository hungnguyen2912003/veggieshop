<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $address = ShippingAddress::where('id', $request->address_id)
            ->where('user_id', Auth::id())->first();

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy địa chỉ!']);
        }

        return response()->json([
            'success' => true,
            'data' => $address
        ]);
    }

    public function placeOrder(Request $request) {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Giỏ hàng trống!');
        }

        DB::beginTransaction();

        try {
            //Create Order
            $order = new Order();
            $order->user_id = $user->id;
            $order->shipping_address_id = $request->address_id;
            $order->total_price = $cartItems->sum(fn(CartItem $item): float|int => $item->quantity * $item->product->price) + 25000;
            $order->status = 'pending'; //Default is pending
            $order->save();

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            //Create payment
            Payment::create([
                'order_id'        => $order->id,
                'payment_method'  => $request->payment_method,
                'amount'          => $order->total_price,
                'status'          => 'pending',
                'paid_at'         => null,
            ]);

            //Delete product in cart when ordered
            CartItem::where('user_id', $user->id)->delete();

            DB::commit();
            toastr()->success(message: 'Đặt hàng thành công!');
            return redirect()->route('account.index');
        } catch (\Exception $e) {
            Log::error('Lỗi đặt hàng: '. $e->getMessage());
            DB::rollBack();
            toastr()->error(message: 'Có lỗi xảy ra, vui lòng thử lại!');
            return redirect()->route('checkout');
        }
    }

    public function placeOrderPaypal(Request $request){
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $cartItems = CartItem::where('user_id',  $user->id)->get();
            //Create Order
            $order = new Order();
            $order->user_id = $user->id;
            $order->shipping_address_id = $request->address_id;
            $order->total_price = $request->amount * 25000;
            $order->status = 'pending'; //Default is pending
            $order->save();

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            //Create payment
            Payment::create([
                'order_id'        => $order->id,
                'payment_method'  => 'paypal',
                'transaction_id'  => $request->transactionID,
                'amount'          => $order->total_price,
                'status'          => 'completed',
                'paid_at'         => now(),
            ]);

            //Delete product in cart when ordered
            CartItem::where('user_id', $user->id)->delete();

            DB::commit();
            return response()->json(['success' => true, 'message'=> 'Thanh toán thành công!']);
        } catch (\Exception $e) {
            Log::error('Lỗi đặt hàng: '. $e->getMessage());
            DB::rollBack();
            toastr()->error('Có lỗi xảy ra, vui lòng thử lại!');
            return redirect()->route('checkout');
        }        
    }
}
