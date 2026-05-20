@extends('layouts.app')

@section('title', 'Мой профиль')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-brickon-red/10 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-user text-3xl text-brickon-red"></i>
                    </div>
                    <h3 class="font-bold text-lg">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
                </div>
                <nav class="space-y-2">
                    <a href="{{ route('profile.index') }}" class="block py-2 px-4 bg-gray-50 rounded-lg text-brickon-red font-medium">
                        <i class="fas fa-user mr-2"></i> Личные данные
                    </a>
                    <a href="{{ route('orders.index') }}" class="block py-2 px-4 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-box mr-2"></i> Мои заказы
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 px-4 hover:bg-gray-50 rounded-lg transition-colors text-red-600">
                            <i class="fas fa-sign-out-alt mr-2"></i> Выйти
                        </button>
                    </form>
                </nav>
            </div>
        </div>
        
        <!-- Форма профиля -->
        <!-- <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-bold mb-6">Личные данные</h2>
                
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Имя</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-brickon-red focus:outline-none">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" value="{{ $user->email }}" disabled 
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50">
                        <p class="text-gray-400 text-xs mt-1">Email нельзя изменить</p>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Телефон</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-brickon-red focus:outline-none"
                               placeholder="+7 (999) 123-45-67">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2">Адрес доставки</label>
                        <textarea name="address" rows="3" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-brickon-red focus:outline-none"
                                  placeholder="Город, улица, дом, квартира">{{ old('address', $user->address ?? '') }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn-primary w-full text-center">
                        Сохранить изменения
                    </button>
                </form>
            </div>
        </div> -->
    </div>
</div>
@endsection