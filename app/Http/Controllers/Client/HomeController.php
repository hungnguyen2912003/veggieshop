<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        foreach ($categories as $index => $category) {
            foreach ($category->products as $product) {
                $product->image_url = $product->firstImage ? asset('storage/uploads/products' . $product->firstImage->image) : asset('storage/uploads/products/default-product.png');
            }
        }

        $bestSellingProducts = Product::select('products.*')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->groupBy('products.id', 'products.name', 'products.slug', 'products.description', 'products.price', 'products.stock', 'products.status', 'products.unit', 'products.category_id')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        return view('client.pages.home', compact('categories', 'bestSellingProducts'));
    }
}
