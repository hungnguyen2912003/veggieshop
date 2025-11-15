<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get()->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'stock' => $item->product->stock,
                    'image' => $item->product->images->first()->image ?? asset('storage/uploads/products/default-product.png'),
                    'slug' => $item->product->slug,
                ];
            })->toArray();
        } else {
            $cartItems = session('cart', []);
        }

        return view('client.pages.cart', compact('cartItems'));
    }

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
        $miniCartItems = [];

        if (auth()->check()) {
            $miniCartItems = CartItem::with('product')->where('user_id', auth()->id())->get();
        } else {
            $miniCartItems = session('cart', []);
        }

        return response()->json([
            'status' => true,
            'html' => view('client.components.includes.mini_cart', compact('miniCartItems'))->render(),
        ]);
    }

    public function removeMiniCart(Request $request)
    {
        $request->validate(['product_id' => 'required']);

        if (Auth::check()) {
            CartItem::where('id', $request->product_id)
                ->where('user_id', Auth::id())
                ->delete();

            $cartItems = CartItem::with('product')
                ->where('user_id', Auth::id())
                ->get();

            $cartCount = $cartItems->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);

            $cartItems = $cart;
            $cartCount = array_sum(array_column($cart, 'quantity'));
        }

        return response()->json([
            'status' => true,
            'cart_count' => $cartCount,
            'html' => view('client.components.includes.mini_cart', compact('cartItems'))->render(),
        ]);
    }

    public function updateCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;

        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())->where('product_id', $productId)->first();
            if (!$cartItem) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng',
                ], 400);
            }

            $product = Product::find($productId);

            if ($quantity > $product->stock) {
                return response()->json([
                    'status' => false,
                    'message' => 'Số lượng sản phẩm không đủ trong kho',
                ], 400);
            }

            $cartItem->quantity = $quantity;
            $cartItem->save();
        } else {
            $cart = session()->get('cart', []);

            if (!isset($cart[$productId])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng',
                ], 400);
            }

            $product = Product::find($productId);

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sản phẩm không tồn tại hoặc đã bị xóa',
                ], 400);
            }

            if ($quantity > $product->stock) {
                return response()->json([
                    'status' => false,
                    'message' => 'Số lượng sản phẩm không đủ trong kho',
                ], 400);
            }

            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        $subtotal = $quantity * $product->price;
        $total = $this->calculateCartTotal();
        $grandTotal = $total;

        return response()->json([
            'quantity' => $quantity,
            'subtotal' => number_format($subtotal, 0, ',', '.'),
            'total' => number_format($total, 0, ',', '.'),
            'grandTotal' => number_format($grandTotal, 0, ',', '.'),
        ]);
    }

    public function removeCartItem(Request $request)
    {
        $productId = $request->product_id;

        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->where('product_id', $productId)->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        $total = $this->calculateCartTotal();
        $grandTotal = $total;

        return response()->json([
            'total' => number_format($total, 0, ',', '.'),
            'grandTotal' => number_format($grandTotal, 0, ',', '.'),
        ]);
    }

    private function calculateCartTotal()
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())->with('product')->get()->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
        } else {
            $cart = session()->get('cart', []);
            return collect($cart)->sum(function ($item) {
                return $item['quantity'] * $item['price'];
            });
        }
    }
}
