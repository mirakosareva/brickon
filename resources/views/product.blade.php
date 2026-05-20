@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <a href="{{ route('catalog') }}" class="inline-flex items-center text-gray-500 hover:text-brickon-red mb-6 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Назад в каталог
    </a>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="product-detail-image bg-gray-50 rounded-2xl overflow-hidden">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-96 object-cover">
            @else
                <div class="w-full h-96 bg-gray-100 flex items-center justify-center">
                    <i class="fas fa-cube fa-6x text-gray-300"></i>
                </div>
            @endif
        </div>

        <div class="product-detail-info">
            <div class="flex flex-wrap gap-2 mb-4">
                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">
                    <i class="fas fa-tag mr-1"></i> {{ $product->category->name }}
                </span>
                @if($product->is_featured)
                <span class="bg-brickon-red text-white px-3 py-1 rounded-full text-sm">
                    <i class="fas fa-star mr-1"></i> Хит продаж
                </span>
                @endif
            </div>
            
            <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $product->name }}</h1>
            
            @if($product->specs)
            <div class="grid grid-cols-2 gap-3 mb-6">
                @foreach(json_decode($product->specs, true) as $key => $value)
                <div class="spec-badge">
                    <small>{{ $key }}</small>
                    <span>{{ $value }}</span>
                </div>
                @endforeach
            </div>
            @endif
            
            <div class="product-price mb-4">
                {{ $product->formatted_price }}
            </div>
            
            <div class="mb-4">
                @if($product->stock > 0)
                    <span class="text-green-600">
                        <i class="fas fa-check-circle mr-1"></i> В наличии: {{ $product->stock }} шт.
                    </span>
                @else
                    <span class="text-red-600">
                        <i class="fas fa-times-circle mr-1"></i> Нет в наличии
                    </span>
                @endif
            </div>
            
            <div class="mb-6">
                <h3 class="font-bold text-lg mb-2">Описание</h3>
                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
            </div>
            
            @if($product->stock > 0)
            <div class="flex items-center gap-4">
                <form action="{{ route('favorites.toggle', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-12 h-12 rounded-full border-2 hover:bg-gray-50 transition-colors flex items-center justify-center">
                        @if(auth()->check() && auth()->user()->hasFavorited($product))
                            <i class="fas fa-heart text-brickon-red text-xl"></i>
                        @else
                            <i class="far fa-heart text-gray-400 text-xl"></i>
                        @endif
                    </button>
                </form>
                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                    @csrf
                    <div class="flex gap-3">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                               class="quantity-input w-20 text-center border border-gray-300 rounded-full py-2">
                        <button type="submit" class="btn-brickon flex-1">
                            <i class="fas fa-shopping-cart mr-2"></i> Добавить в корзину
                        </button>
                    </div>
                </form>
            </div>
            @else
                <button class="bg-gray-300 text-gray-500 w-full py-3 rounded-full cursor-not-allowed">
                    <i class="fas fa-times-circle mr-2"></i> Нет в наличии
                </button>
            @endif
        </div>
    </div>
    
    @if(isset($similarProducts) && $similarProducts->count() > 0)
    <div class="mt-16">
        <h2 class="text-2xl font-bold mb-6">Вам также может понравиться</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($similarProducts as $similar)
            <a href="{{ route('product.show', $similar) }}" class="product-card block">
                <div class="h-40 overflow-hidden">
                    @if($similar->image)
                        <img src="{{ asset('storage/' . $similar->image) }}" 
                             alt="{{ $similar->name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-cube fa-2x text-gray-300"></i>
                        </div>
                    @endif
                </div>
                <div class="p-3">
                    <h3 class="font-bold text-sm mb-1 line-clamp-2">{{ $similar->name }}</h3>
                    <span class="text-brickon-red font-bold">{{ $similar->formatted_price }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection