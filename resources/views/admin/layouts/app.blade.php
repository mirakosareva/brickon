<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Brickon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('admin.products.index') }}" class="font-bold text-lg">🏠 Admin Brickon</a>
                    <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-brickon-red">Товары</a>
                    <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-brickon-red">Категории</a>
                    <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:text-brickon-red">Заказы</a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">{{ auth()->user()->name }}</span>
                    <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-brickon-red">На сайт</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-500">Выйти</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="max-w-7xl mx-auto px-4 py-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>