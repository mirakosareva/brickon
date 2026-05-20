@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" 
                     alt="{{ $category->name }}" 
                     class="w-16 h-16 object-cover rounded-full">
            @else
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-tag text-2xl text-gray-400"></i>
                </div>
            @endif
            <div>
                <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
                @if($category->description)
                    <p class="text-gray-600 mt-1">{{ $category->description }}</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-brickon-red">Главная</a>
        <span class="mx-2">/</span>
        <a href="{{ route('catalog') }}" class="hover:text-brickon-red">Каталог</a>
        <span class="mx-2">/</span>
        <span class="text-gray-700">{{ $category->name }}</span>
    </div>
    
    <p class="text-gray-500 mb-6">Найдено {{ $products->total() }} товаров</p>
    
    @if($products->count() > 0)
        <div class="lego-grid">
            @foreach($products as $product)
            <div class="product-card group">
                <div class="relative overflow-hidden h-64">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-cube fa-4x text-gray-300"></i>
                        </div>
                    @endif
                    @if($product->is_featured)
                        <div class="absolute top-3 left-3 bg-brickon-red text-white text-xs font-bold px-2 py-1 rounded">
                            ХИТ
                        </div>
                    @endif
                    @if($product->stock <= 0)
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                            <span class="bg-white text-black px-4 py-2 rounded-full font-bold">Нет в наличии</span>
                        </div>
                    @endif
                </div>
                
                <div class="p-4">
                    <div class="text-sm text-gray-500 mb-2">
                        <i class="fas fa-tag mr-1"></i> {{ $product->category->name }}
                    </div>
                    <a href="{{ route('product.show', $product) }}">
                        <h3 class="text-lg font-bold mb-2 group-hover:text-brickon-red transition-colors line-clamp-2">
                            {{ $product->name }}
                        </h3>
                    </a>
                    
                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <span class="text-xl font-bold text-brickon-red">{{ $product->formatted_price }}</span>
                        </div>
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-black text-white px-4 py-2 rounded-full hover:bg-brickon-red transition-colors">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </form>
                        @else
                            <button disabled class="bg-gray-300 text-gray-500 px-4 py-2 rounded-full cursor-not-allowed">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $products->withQueryString()->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-cube text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-bold mb-2">В этой категории пока нет товаров</h3>
            <p class="text-gray-600">Загляните позже, мы пополняем ассортимент</p>
            <a href="{{ route('catalog') }}" class="btn-primary mt-4 inline-block">Вернуться в каталог</a>
        </div>
    @endif
</div>
@endsection