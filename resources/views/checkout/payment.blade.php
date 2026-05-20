@extends('layouts.app')

@section('title', 'Оплата заказа')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="bg-white rounded-xl shadow-sm p-8 text-center">
        <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-credit-card text-3xl text-yellow-600"></i>
        </div>
        
        <h1 class="text-2xl font-bold mb-2">Имитация оплаты</h1>
        <p class="text-gray-500 mb-6">Заказ №{{ $order->order_number }} на сумму <span class="font-bold text-brickon-red">{{ number_format($order->total_amount, 0, '.', ' ') }} ₽</span></p>
        
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
            <p class="text-sm text-yellow-800">
                <i class="fas fa-info-circle mr-2"></i>
                Это демонстрационный режим. Реальные деньги не списываются.
            </p>
        </div>
        
        <form method="POST" action="{{ route('checkout.payment.simulate', $order) }}">
            @csrf
            <button type="submit" class="btn-primary w-full">
                <i class="fas fa-check-circle mr-2"></i> Оплатить (имитация)
            </button>
        </form>
        
        <a href="{{ route('orders.show', $order) }}" class="block text-gray-500 hover:text-brickon-red mt-4">
            Вернуться к заказу
        </a>
    </div>
</div>
@endsection