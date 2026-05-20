@extends('layouts.app')

@section('title', 'Мои заказы')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold">Мои заказы</h1>
        <a href="{{ route('profile.edit') }}" class="text-gray-500 hover:text-brickon-red">
            <i class="fas fa-user mr-1"></i> Редактировать профиль
        </a>
    </div>
    
    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
            <div class="bg-white rounded-xl shadow-sm p-4 hover:shadow-md transition-shadow">
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <div>
                        <span class="text-sm text-gray-500">Заказ №</span>
                        <span class="font-bold">{{ $order->order_number }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Дата:</span>
                        <span>{{ $order->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Сумма:</span>
                        <span class="font-bold text-brickon-red">{{ number_format($order->total_amount, 0, '.', ' ') }} ₽</span>
                    </div>
                    <div>
                        @if($order->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">Ожидает</span>
                        @elseif($order->status == 'processing')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">Обработка</span>
                        @elseif($order->status == 'completed')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Выполнен</span>
                        @elseif($order->status == 'cancelled')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">Отменён</span>
                        @endif
                    </div>
                    <div>
                        @if($order->payment_status == 'paid')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Оплачен</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">Не оплачен</span>
                        @endif
                    </div>
                    <a href="{{ route('orders.show', $order) }}" class="text-brickon-red hover:underline text-sm">
                        Подробнее →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-xl shadow-sm">
            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold mb-2">У вас пока нет заказов</h3>
            <p class="text-gray-500 mb-6">Перейдите в каталог и сделайте первый заказ</p>
            <a href="{{ route('catalog') }}" class="btn-primary inline-block">Перейти в каталог</a>
        </div>
    @endif
</div>
@endsection