@extends('layouts.app')

@section('title', 'Каталог конструкторов')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Каталог LEGO</h1>
            <p class="text-gray-600 text-lg">
                {{ $products->total() }} наборов для творчества
            </p>
        </div>
        
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="lg:w-1/4">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                    <h3 class="font-bold text-lg mb-4">Фильтры</h3>
                    
                    <form method="GET" action="{{ route('catalog') }}" id="filter-form">
                        <div class="mb-6">
                            <h4 class="font-semibold mb-3">Категории</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="category" value="" 
                                           {{ !request('category') ? 'checked' : '' }}
                                           class="mr-2 text-brickon-red" onchange="this.form.submit()">
                                    <span>Все</span>
                                </label>
                                @foreach($categories as $category)
                                <label class="flex items-center">
                                    <input type="radio" name="category" value="{{ $category->slug }}"
                                           {{ request('category') == $category->slug ? 'checked' : '' }}
                                           class="mr-2 text-brickon-red" onchange="this.form.submit()">
                                    <span>{{ $category->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h4 class="font-semibold mb-3">Цена</h4>
                            <div class="flex gap-2">
                                <input type="number" name="min_price" placeholder="От" 
                                       value="{{ request('min_price') }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-brickon-red focus:outline-none"
                                       onchange="this.form.submit()">
                                <input type="number" name="max_price" placeholder="До" 
                                       value="{{ request('max_price') }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-brickon-red focus:outline-none"
                                       onchange="this.form.submit()">
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="font-semibold mb-3">Сортировка</h4>
                            <select name="sort" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-brickon-red focus:outline-none" onchange="this.form.submit()">
                                <option value="">По новизне</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Сначала дешевле</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Сначала дороже</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>По названию (А-Я)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>По названию (Я-А)</option>
                            </select>
                        </div>
                        
                        @if(request()->anyFilled(['category', 'min_price', 'max_price', 'sort']))
                        <div class="mt-4">
                            <a href="{{ route('catalog') }}" class="text-brickon-red text-sm hover:underline">
                                <i class="fas fa-times mr-1"></i> Сбросить фильтры
                            </a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
            
            <div class="lg:w-3/4">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                        <div class="product-card group relative bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300">
                            <a href="{{ route('product.show', $product) }}" class="absolute inset-0 z-10">
                                <span class="sr-only">{{ $product->name }}</span>
                            </a>
                            <div class="overflow-hidden h-64">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                        <i class="fas fa-cube fa-4x text-gray-300"></i>
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
                                <a href="{{ route('product.show', $product) }}" class="block">
                                    <h3 class="text-lg font-bold mb-2 group-hover:text-brickon-red transition-colors line-clamp-2">
                                        {{ $product->name }}
                                    </h3>
                                </a>
                                
                                <div class="flex items-center justify-between mt-4">
                                    <div>
                                        <span class="text-xl font-bold text-brickon-red">{{ $product->formatted_price }}</span>
                                    </div>
                                    @if($product->stock > 0)
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
                        <h3 class="text-xl font-bold mb-2">Товары не найдены</h3>
                        <p class="text-gray-600">Попробуйте изменить параметры фильтрации</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection