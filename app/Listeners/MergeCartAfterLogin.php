<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MergeCartAfterLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $sessionCart = session()->get('cart', []);

        if (!empty($sessionCart)) {
            foreach ($sessionCart as $productId => $cartItem) {
                // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của user chưa
                $existingCartItem = \App\Models\CartItem::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->first();

                if ($existingCartItem) {
                    // Nếu đã có, cộng dồn số lượng
                    $existingCartItem->quantity += $cartItem['quantity'];
                    $existingCartItem->save();
                } else {
                    // Nếu chưa có, tạo mới bản ghi
                    \App\Models\CartItem::create([
                        'user_id' => $user->id,
                        'product_id' => $productId,
                        'quantity' => $cartItem['quantity'],
                    ]);
                }
            }

            // Xóa giỏ hàng trong session sau khi đồng bộ xong
            session()->forget('cart');
        }
    }
}
