<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }
        $items = $order->items()->with('product')->get();
        
        return view('orders.show', compact('order', 'items'));
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }
        $items = [];
        $total = 0;
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal = $product->price * $quantity;
                $items[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }
        
        return view('checkout.index', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }
        
        $request->validate([
            'address' => 'required|string|min:5',
            'payment_method' => 'required|string',
        ]);
        
        $total = 0;
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $total += $product->price * $quantity;
            }
        }
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => $total,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_method' => $request->payment_method,
            'shipping_address' => $request->address,
            'notes' => $request->notes,
        ]);
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $product->stock >= $quantity) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);
                $product->decrement('stock', $quantity);
            }
        }
        
        Session::forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Заказ успешно оформлен!');
    }
}