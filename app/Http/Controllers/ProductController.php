<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->take(8)
            ->get();
    
        $newProducts = Product::where('is_active', true)
            ->latest()
            ->take(4)
            ->get();
        
        return view('home', compact('featuredProducts', 'newProducts'));
    }
    
   
    public function catalog(Request $request)
    {
        $query = Product::where('is_active', true);
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
        }
        $products = $query->paginate(9);
        $categories = Category::all();

        return view('catalog', compact('products', 'categories'));
    }
    
    
    public function show(Product $product)
    {

        if (!$product->is_active) {
            abort(404);
        }
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();
        
        return view('product', compact('product', 'similarProducts'));
    }
    
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return redirect()->back()->with('error', 'Введите минимум 2 символа для поиска');
        }
        $products = Product::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->paginate(12);
        
        return view('search-results', compact('products', 'query'));
    }
}
