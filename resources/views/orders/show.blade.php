@extends('layouts.app')

@section('title', 'Заказ ' . $order->order_number)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <a href="{{ route('orders.index') }}" class="inline-flex items-center text-gray-500 hover:text-brickon-red mb-6">
        <i class="fas fa-arrow-left mr-2"></i> Мои заказы
    </a>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-bold mb-4">Детали заказа</h2>
                <div class="space-y-4">
                    @foreach($items as $item)
                    <div class="flex justify-between items-center pb-3 border-b">
                        <div>
                            <p class="font-medium">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">{{ $item->quantity }} шт × {{ number_format($item->price, 0, '.', ' ') }} ₽</p>
                        </div>
                        <p class="font-bold">{{ number_format($item->quantity * $item->price, 0, '.', ' ') }} ₽</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-4 pt-3 border-t flex justify-between">
                    <span class="font-bold">Итого:</span>
                    <span class="font-bold text-xl text-brickon-red">{{ number_format($order->total_amount, 0, '.', ' ') }} ₽</span>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-bold mb-4">Информация о заказе</h3>
                
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="text-gray-500">Номер:</span>
                        <span class="ml-2 font-medium">{{ $order->order_number }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Дата:</span>
                        <span class="ml-2">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Статус:</span>
                        <span class="ml-2">
                            @if($order->status == 'pending')
                                Ожидает обработки
                            @elseif($order->status == 'processing')
                                Обрабатывается
                            @elseif($order->status == 'completed')
                                Выполнен
                            @elseif($order->status == 'cancelled')
                                Отменён
                            @endif
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-500">Оплата:</span>
                        <span class="ml-2">
                            @if($order->payment_status == 'paid')
                                <span class="text-green-600">Оплачен</span>
                            @else
                                <span class="text-red-600">Не оплачен</span>
                            @endif
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-500">Способ оплаты:</span>
                        <span class="ml-2">{{ $order->payment_method ?? 'Не выбран' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Адрес:</span>
                        <span class="ml-2 block mt-1">{{ $order->shipping_address }}</span>
                    </div>
                    @if($order->notes)
                    <div>
                        <span class="text-gray-500">Комментарий:</span>
                        <p class="mt-1 text-gray-600">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
                
                @if($order->payment_status != 'paid' && $order->status == 'pending')
                    <div class="mt-6 pt-4 border-t">
                        <a href="{{ route('checkout.payment', $order) }}" class="btn-primary block text-center">
                            Оплатить заказ
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection