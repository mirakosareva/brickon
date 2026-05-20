@extends('layouts.app')

@section('title', 'Результаты поиска')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-4">Результаты поиска: "{{ $query }}"</h1>
    <p class="text-gray-500 mb-8">Найдено {{ $products->total() }} товаров</p>
    
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
                </div>
                <div class="p-4">
                    <div class="text-sm text-gray-500 mb-2">
                        <i class="fas fa-tag mr-1"></i> {{ $product->category->name }}
                    </div>
                    <a href="{{ route('product.show', $product) }}">
                        <h3 class="text-lg font-bold mb-2 group-hover:text-brickon-red transition-colors">
                            {{ $product->name }}
                        </h3>
                    </a>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-xl font-bold text-brickon-red">{{ $product->formatted_price }}</span>
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-black text-white px-4 py-2 rounded-full hover:bg-brickon-red transition-colors">
                                <i class="fas fa-shopping-cart"></i> Купить
                            </button>
                        </form>
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
            <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-2xl font-bold mb-2">Ничего не найдено</h2>
            <p class="text-gray-500 mb-6">Попробуйте изменить поисковый запрос</p>
            <a href="{{ route('catalog') }}" class="btn-primary">Вернуться в каталог</a>
        </div>
    @endif
</div>
@endsection