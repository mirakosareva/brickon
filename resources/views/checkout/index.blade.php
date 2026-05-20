@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-8">Оформление заказа</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('order.store') }}" class="bg-white rounded-xl shadow-sm p-6">
                @csrf
                <div class="mb-6">
                    <label for="address" class="block font-bold mb-2">Адрес доставки <span class="text-red-500">*</span></label>
                    <textarea name="address" id="address" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-brickon-red focus:outline-none"
                              placeholder="Город, улица, дом, квартира"
                              required>{{ old('address', Auth::user()->address ?? '') }}</textarea>
                    <p class="text-gray-400 text-xs mt-1">Укажите точный адрес для доставки</p>
                </div>
                <div class="mb-6">
                    <label class="block font-bold mb-2">Способ оплаты <span class="text-red-500">*</span></label>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="payment_method" value="simulation" checked class="mr-3">
                            <div>
                                <span class="font-medium">💳 Имитация оплаты</span>
                                <p class="text-sm text-gray-500">Демонстрационный режим (без реального списания)</p>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="payment_method" value="cash" class="mr-3">
                            <div>
                                <span class="font-medium">💵 Наличными при получении</span>
                                <p class="text-sm text-gray-500">Оплата курьеру при доставке</p>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="payment_method" value="card" class="mr-3">
                            <div>
                                <span class="font-medium">💳 Картой онлайн</span>
                                <p class="text-sm text-gray-500">Безопасная оплата банковской картой</p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="notes" class="block font-bold mb-2">Комментарий к заказу</label>
                    <textarea name="notes" id="notes" rows="2" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-brickon-red focus:outline-none"
                              placeholder="Особые пожелания, подъезд, домофон...">{{ old('notes') }}</textarea>
                </div>
                
                <div class="border-t pt-4">
                    <p class="text-sm text-gray-500 mb-4">
                        <i class="fas fa-info-circle mr-1"></i>
                        Нажимая «Подтвердить заказ», вы соглашаетесь с условиями обработки персональных данных
                    </p>
                    <button type="submit" class="btn-primary w-full text-center">
                        <i class="fas fa-check-circle mr-2"></i> Подтвердить заказ
                    </button>
                </div>
            </form>
        </div>
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                <h3 class="font-bold text-lg mb-4">Ваш заказ</h3>
                
                <div class="space-y-3 max-h-96 overflow-y-auto mb-4">
                    @foreach($items as $item)
                    <div class="flex justify-between text-sm">
                        <div>
                            <span class="font-medium">{{ $item['name'] }}</span>
                            <span class="text-gray-500"> × {{ $item['quantity'] }}</span>
                        </div>
                        <span class="font-bold">{{ number_format($item['subtotal'], 0, '.', ' ') }} ₽</span>
                    </div>
                    @endforeach
                </div>
                
                <div class="border-t pt-4">
                    <div class="flex justify-between mb-2">
                        <span>Товары ({{ count($items) }} шт):</span>
                        <span>{{ number_format($total, 0, '.', ' ') }} ₽</span>
                    </div>
                    <div class="flex justify-between mb-2 text-gray-500">
                        <span>Доставка:</span>
                        <span>Бесплатно</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold pt-3 border-t mt-2">
                        <span>Итого:</span>
                        <span class="text-brickon-red">{{ number_format($total, 0, '.', ' ') }} ₽</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection