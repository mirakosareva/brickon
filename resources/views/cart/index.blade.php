@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-8">Корзина</h1>
    
    @if(count($items) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                @foreach($items as $item)
                <div class="flex gap-4 border-b py-4">
                    <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                        @if($item['image'])
                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover rounded-lg">
                        @else
                            <i class="fas fa-cube text-3xl text-gray-400"></i>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold">{{ $item['name'] }}</h3>
                        <p class="text-brickon-red font-bold">{{ $item['price'] }} ₽</p>
                        <div class="flex items-center gap-3 mt-2">
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" 
                                       class="w-16 px-2 py-1 border rounded text-center" 
                                       onchange="this.form.submit()">
                            </form>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i> Удалить
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">{{ $item['subtotal'] }} ₽</p>
                    </div>
                </div>
                @endforeach
            </div>
        
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="font-bold text-lg mb-4">Итого</h3>
                    <div class="flex justify-between mb-2">
                        <span>Товары ({{ count($items) }}):</span>
                        <span>{{ $total }} ₽</span>
                    </div>
                    <div class="flex justify-between mb-4">
                        <span>Доставка:</span>
                        <span>Рассчитывается</span>
                    </div>
                    <div class="border-t pt-4 mb-4">
                        <div class="flex justify-between font-bold text-lg">
                            <span>К оплате:</span>
                            <span class="text-brickon-red">{{ $total }} ₽</span>
                        </div>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn-primary w-full text-center block">
                        Оформить заказ
                    </a>
                    <a href="{{ route('catalog') }}" class="block text-center text-gray-500 hover:text-brickon-red mt-3 text-sm">
                        ← Продолжить покупки
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-2xl font-bold mb-2">Корзина пуста</h2>
            <p class="text-gray-500 mb-6">Добавьте товары в корзину, чтобы продолжить</p>
            <a href="{{ route('catalog') }}" class="btn-primary">Перейти в каталог</a>
        </div>
    @endif
</div>
@endsection