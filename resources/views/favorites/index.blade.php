@extends('layouts.app')

@section('title', 'Избранное')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-8">❤️ Избранное</h1>
    
    @if($products->count() > 0)
        <div class="lego-grid">
            @foreach($products as $product)
            <div class="product-card group relative">
                <a href="{{ route('product.show', $product) }}" class="absolute inset-0 z-10">
                    <span class="sr-only">{{ $product->name }}</span>
                </a>
                
                <div class="relative overflow-hidden h-64">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                </div>
                
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2">{{ $product->name }}</h3>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-xl font-bold text-brickon-red">{{ $product->formatted_price }}</span>
                        
                        <form action="{{ route('favorites.toggle', $product) }}" method="POST" class="relative z-20">
                            @csrf
                            <button type="submit" class="favorite-btn w-10 h-10 rounded-full bg-red-50 flex items-center justify-center">
                                <i class="fas fa-heart text-brickon-red"></i>
                            </button>
                        </form>
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="relative z-20">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-black text-white px-4 py-2 rounded-full hover:bg-brickon-red transition-colors flex items-center space-x-2">
                                <i class="fas fa-shopping-cart text-sm"></i>
                                <span class="text-sm font-medium">Купить</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="far fa-heart text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-2xl font-bold mb-2">Избранное пусто</h2>
            <p class="text-gray-500 mb-6">Добавляйте товары в избранное, чтобы не потерять их</p>
            <a href="{{ route('catalog') }}" class="btn-primary inline-block">Перейти в каталог</a>
        </div>
    @endif
</div>
@endsection