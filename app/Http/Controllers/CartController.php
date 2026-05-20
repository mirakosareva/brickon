<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            $items = [];
            $total = 0;
        } 
        else {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)
                ->where('is_active', true)
                ->get()
                ->keyBy('id');
            $items = [];
            $total = 0;
            
            foreach ($cart as $productId => $quantity) {
                if (isset($products[$productId])) {
                    $product = $products[$productId];
                    $subtotal = $product->price * $quantity;
                    
                    $items[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal,
                        'image' => $product->image,
                    ];
                    
                    $total += $subtotal;
                }
            }
        }
        
        return view('cart.index', compact('items', 'total'));
    }
    
    public function add(Request $request, Product $product)
    {
        if (!$product->is_active || $product->stock <= 0) {
            return redirect()->back()->with('error', 'Этот товар временно недоступен');
        }
        
        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);
        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }
        if ($cart[$product->id] > $product->stock) {
            return redirect()->back()->with('error', "К сожалению, доступно только {$product->stock} шт.");
        }
        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', "Товар добавлен в корзину");
    }
    
   
    public function update(Request $request, $productId)
    {
        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);
        
        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            
            if ($product && $quantity > $product->stock) {
                return redirect()->back()->with('error', "Доступно только {$product->stock} шт.");
            }
            
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId] = $quantity;
            }
            
            Session::put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Корзина обновлена');
    }
    
  
    public function remove($productId)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Товар удален из корзины');
    }
    
   
    public function clear()
    {
        Session::forget('cart');
        
        return redirect()->route('cart.index')->with('success', 'Корзина очищена');
    }
}
