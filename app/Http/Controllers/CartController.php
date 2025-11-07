<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->merge(['quantity' => (int) $request->quantity]);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($request->quantity > $product->stock) {
            return response()->json([
                'status' => false,
                'message' => 'Số lượng sản phẩm không đủ trong kho',
            ], 400);
        }

        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);
            }

            $cartCount = CartItem::where('user_id', Auth::id())->count();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->product_id])) {
                $cart[$request->product_id]['quantity'] += $request->quantity;
            } else {
                $cart[$request->product_id] = [
                    'product_id' => $request->product_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $request->quantity,
                    'stock' => $product->stock,
                    'image' => $product->images->first()->image ?? asset('storage/uploads/products/default-product.png'),
                ];
            }
            session()->put('cart', $cart);
            $cartCount = count($cart);
        }

        return response()->json([
            'message' => true,
            'cart_count' => $cartCount,
        ]);
    }

    public function loadMiniCart()
    {
        $cartItems = [];

        if (auth()->check()) {
            $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();
        } else {
            $cartItems = session('cart', []);
        }

        return response()->json([
            'status' => true,
            'html' => view('client.components.includes.mini_cart', compact('cartItems'))->render(),
        ]);
    }
}
