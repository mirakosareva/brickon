@extends('layouts.app')

@section('title', 'Конструкторы LEGO для творчества')

@section('content')
    <div class="relative overflow-hidden bg-gradient-to-br from-white via-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="fade-up">
                    <div class="inline-flex items-center space-x-2 bg-brickon-red/10 text-brickon-red px-4 py-2 rounded-full mb-6">
                        <i class="fas fa-cube text-sm"></i>
                        <span class="text-sm font-medium">Официальный магазин</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                        Собери свою
                        <span class="text-brickon-red">историю</span>
                        <br>с LEGO
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Тысячи уникальных наборов для творчества. От классических городов до сложных механизмов Technic.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('catalog') }}" class="btn-primary text-center">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Начать покупки
                        </a>
                        <a href="#categories" class="btn-secondary text-center">
                            <i class="fas fa-compass mr-2"></i>
                            Исследовать категории
                        </a>
                    </div>
                </div>
                <div class="relative fade-up delay-200">
                    <div class="relative z-10">
                        <div class="absolute -top-10 -left-10 w-72 h-72 bg-brickon-red/10 rounded-full blur-3xl animate-float"></div>
                        <img src="https://images.unsplash.com/photo-1587654780291-39c9404d746b?w=600&h=600&fit=crop" 
                             alt="LEGO Collection" 
                             class="relative z-20 w-full max-w-md mx-auto rounded-2xl shadow-2xl">
                    </div>
                    <div class="absolute bottom-0 right-0 w-32 h-32 bg-brickon-red/20 rounded-full blur-xl"></div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-white to-transparent"></div>
    </div>
    <div id="categories" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Категории конструкторов</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Выберите свою любимую серию и начните сборку
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $categories = App\Models\Category::all();
            @endphp
            @foreach($categories as $category)
            <a href="{{ route('category.show', $category) }}" class="group">
                <div class="category-tile relative h-64 rounded-2xl overflow-hidden">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" 
                             alt="{{ $category->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <i class="fas fa-cube text-6xl text-gray-300"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <h3 class="text-2xl font-bold mb-2">{{ $category->name }}</h3>
                        <p class="text-sm opacity-90">{{ $category->description ?? 'Откройте мир творчества' }}</p>
                        <div class="mt-3 inline-flex items-center text-brickon-red group-hover:translate-x-2 transition-transform">
                            <span class="text-sm font-medium">Смотреть наборы</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    
    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
    <div class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="inline-flex items-center space-x-2 bg-brickon-red/10 text-brickon-red px-4 py-2 rounded-full mb-4">
                    <i class="fas fa-star"></i>
                    <span class="text-sm font-medium">Рекомендуем</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Популярные наборы</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Самые любимые конструкторы наших покупателей
                </p>
            </div>
            
            <div class="lego-grid">
                @foreach($featuredProducts as $product)
                <div class="product-card group relative">
                    <a href="{{ route('product.show', $product) }}" class="absolute inset-0 z-10">
                        <span class="sr-only">{{ $product->name }}</span>
                    </a>
                    <div class="overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
                                <i class="fas fa-cube fa-4x text-gray-300"></i>
                            </div>
                        @endif
                        @if($product->is_featured)
                            <div class="absolute top-3 left-3 bg-brickon-red text-white text-xs font-bold px-2 py-1 rounded">
                                ХИТ
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <div class="text-sm text-gray-500 mb-2">
                            <i class="fas fa-tag mr-1"></i> {{ $product->category->name }}
                        </div>
                        <h3 class="text-xl font-bold mb-2 group-hover:text-brickon-red transition-colors">
                            {{ $product->name }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($product->description, 100) }}
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-brickon-red">{{ $product->formatted_price }}</span>
                            </div>
                            <form action="{{ route('favorites.toggle', $product) }}" method="POST" class="favorite-form relative z-20">
                                @csrf
                                <button type="submit" class="favorite-btn w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors flex items-center justify-center">
                                    @if(auth()->check() && auth()->user()->hasFavorited($product))
                                        <i class="fas fa-heart text-brickon-red"></i>
                                    @else
                                        <i class="far fa-heart text-gray-600"></i>
                                    @endif
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
            
            <div class="text-center mt-12">
                <a href="{{ route('catalog') }}" class="inline-flex items-center space-x-2 text-brickon-red font-semibold hover:space-x-3 transition-all">
                    <span>Смотреть весь каталог</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
   
    @if(isset($newProducts) && $newProducts->count() > 0)
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-12">
            <div class="inline-flex items-center space-x-2 bg-brickon-red/10 text-brickon-red px-4 py-2 rounded-full mb-4">
                <i class="fas fa-gem"></i>
                <span class="text-sm font-medium">Только что появились</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Новинки коллекций</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Первыми получите самые свежие наборы LEGO
            </p>
        </div>
        
        <div class="lego-grid">
            @foreach($newProducts as $product)
            <div class="product-card group relative">
                <a href="{{ route('product.show', $product) }}" class="absolute inset-0 z-10">
                    <span class="sr-only">{{ $product->name }}</span>
                </a>
                <div class="overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-cube fa-4x text-gray-300"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">
                        NEW
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">
                        <i class="fas fa-tag mr-1"></i> {{ $product->category->name }}
                    </div>
                    <h3 class="text-xl font-bold mb-2 group-hover:text-brickon-red transition-colors">
                        {{ $product->name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ Str::limit($product->description, 100) }}
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-2xl font-bold text-brickon-red">{{ $product->formatted_price }}</span>
                        </div>
                        <form action="{{ route('favorites.toggle', $product) }}" method="POST" class="favorite-form relative z-20">
                            @csrf
                            <button type="submit" class="favorite-btn w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors flex items-center justify-center">
                                @if(auth()->check() && auth()->user()->hasFavorited($product))
                                    <i class="fas fa-heart text-brickon-red"></i>
                                @else
                                    <i class="far fa-heart text-gray-600"></i>
                                @endif
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
    </div>
    @endif
    
    <div class="bg-brickon-black text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="fade-up">
                    <div class="inline-flex items-center space-x-2 bg-white/10 px-4 py-2 rounded-full mb-6">
                        <i class="fas fa-lightbulb"></i>
                        <span class="text-sm">Вдохновение</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">
                        Создай что-то<br>уникальное
                    </h2>
                    <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                        LEGO — это не просто конструктор. Это инструмент для воплощения самых смелых идей. Собери свой мир, свою историю, свою вселенную.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="inline-flex items-center space-x-2 text-brickon-red font-semibold hover:space-x-3 transition-all">
                            <span>Посмотреть идеи для сборки</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 fade-up delay-200">
                    <div class="space-y-4">
                        <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <i class="fas fa-cubes text-3xl text-brickon-red mb-2"></i>
                            <p class="text-sm">1000+ деталей</p>
                        </div>
                        <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <i class="fas fa-users text-3xl text-brickon-red mb-2"></i>
                            <p class="text-sm">Для всей семьи</p>
                        </div>
                    </div>
                    <div class="space-y-4 mt-8">
                        <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <i class="fas fa-brain text-3xl text-brickon-red mb-2"></i>
                            <p class="text-sm">Развивает мышление</p>
                        </div>
                        <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <i class="fas fa-gem text-3xl text-brickon-red mb-2"></i>
                            <p class="text-sm">Коллекционные серии</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush