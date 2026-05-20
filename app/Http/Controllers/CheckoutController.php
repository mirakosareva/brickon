<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index()
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
        
        $user = Auth::user();
        
        return view('checkout.index', compact('items', 'total', 'user'));
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
        
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => 0,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_method' => $request->payment_method,
            'shipping_address' => $request->address,
            'notes' => $request->notes,
        ]);
        $total = 0;
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $product->stock >= $quantity) {
                $subtotal = $product->price * $quantity;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);
                $total += $subtotal;
                $product->decrement('stock', $quantity);
            }
        }
        
        $order->update(['total_amount' => $total]);
        Session::forget('cart');
        if ($request->payment_method == 'simulation') {
            return redirect()->route('checkout.payment', $order);
        }
        
        return redirect()->route('orders.show', $order)->with('success', 'Заказ оформлен!');
    }
    
    public function payment(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }
        
        return view('checkout.payment', compact('order'));
    }
    
    public function paymentSimulate(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            abort(403);
        }
        $order->update([
            'payment_status' => 'paid',
            'status' => 'processing',
        ]);
        
        return redirect()->route('orders.show', $order)->with('success', 'Оплата прошла успешно (имитация)');
    }
}