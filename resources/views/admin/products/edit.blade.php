@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Новый товар</h1>
    <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-brickon-red">← Назад</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.products.store') }}" method="PUT" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Название</label>
                <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Slug</label>
                <input type="text" name="slug" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Категория</label>
                <select name="category_id" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">Выберите</option>
                    @foreach($categories as $category)
                        <option value="{{ $product->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium mb-1">Цена (₽)</label>
                <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Остаток</label>
                <input type="number" name="stock" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Фото</label>
                <input type="file" name="image" accept="image/*" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div class="col-span-2">
                <label class="block font-medium mb-1">Описание</label>
                <textarea name="description" rows="5" class="w-full border rounded-lg px-3 py-2" required></textarea>
            </div>
        </div>
        
        <div class="mt-6">
            <button type="submit" class="bg-brickon-red text-white px-6 py-2 rounded-lg hover:bg-red-700">Сохранить</button>
        </div>
    </form>
</div>
@endsection