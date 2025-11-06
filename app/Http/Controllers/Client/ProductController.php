<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        $products = Product::with('firstImage')->where('status', 'in_stock')->paginate(9);
        foreach ($products as $product) {
            $product->image_url = $product->firstImage ? asset('storage/uploads/products' . $product->firstImage->image) : asset('storage/uploads/products/default-product.png');
        }
        return view('client.pages.products', compact('categories', 'products'));
    }
}
