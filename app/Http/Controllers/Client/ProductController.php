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
            $product->image_url = $product->firstImage
                ? asset('storage/uploads/products/' . $product->firstImage->image)
                : asset('storage/uploads/products/default-product.png');
        }
        return view('client.pages.products', compact('categories', 'products'));
    }

    public function filter(Request $request)
    {
        $query = Product::query();
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }


        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        $products = $query->paginate(9);

        foreach ($products as $product) {
            $product->image_url = $product->firstImage
                ? asset('storage/uploads/products/' . $product->firstImage->image)
                : asset('storage/uploads/products/default-product.png');
        }

        return response()->json([
            'products' => view('client.components.product-grid', compact('products'))->render()
        ]);
    }
}
