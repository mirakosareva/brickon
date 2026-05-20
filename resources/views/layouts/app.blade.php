<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Brickon - @yield('title', 'Конструкторы LEGO для творчества')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Vite для Tailwind -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles') -->

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brickon-red': '#E3002B',
                    }
                }
            }
        }
    </script>
    <style>
        /* Сетка для товаров - 3 колонки */
        .lego-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        /* Для больших экранов - максимум 3 колонки */
        @media (min-width: 1024px) {
            .lego-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Карточка товара */
        .product-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Категория-плитка */
        .category-tile {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            transition: all 0.3s;
            cursor: pointer;
        }

        .category-tile:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Кнопки */
        .btn-primary {
            background-color: #E3002B;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #b80022;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(227, 0, 43, 0.3);
        }

        .btn-secondary {
            border: 2px solid #E3002B;
            color: #E3002B;
            background: transparent;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-secondary:hover {
            background-color: #E3002B;
            color: white;
        }

        /* Анимации */
        .fade-up {
            animation: slideUp 0.6s ease-out forwards;
            opacity: 0;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Ограничение текста */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Цвета */
        .bg-brickon-black {
            background-color: #1A1A1A;
        }

        .text-brickon-black {
            color: #1A1A1A;
        }
    </style>
</head>

<body class="bg-white">
    <nav class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-md z-50 border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                        <div class="relative">
                            <i class="fas fa-cube text-brickon-red text-2xl group-hover:scale-110 transition-transform"></i>
                            <div class="absolute -top-1 -right-1 w-2 h-2 bg-brickon-red rounded-full animate-pulse"></div>
                        </div>
                        <span class="text-2xl font-bold tracking-tight">
                            <span class="text-brickon-black">Brick</span>
                            <span class="text-brickon-red">on</span>
                        </span>
                    </a>
                    <div class="hidden md:flex space-x-6">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-brickon-red transition-colors font-medium">
                            Главная
                        </a>
                        <a href="{{ route('catalog') }}" class="text-gray-600 hover:text-brickon-red transition-colors font-medium">
                            Каталог
                        </a>
                        <!-- <a href="{{ route('catalog') }}?sort=popular" class="text-gray-600 hover:text-brickon-red transition-colors font-medium">
                            Популярное
                        </a>
                        <a href="{{ route('catalog') }}?sort=new" class="text-gray-600 hover:text-brickon-red transition-colors font-medium">
                            Новинки
                        </a> -->
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <form action="{{ route('product.search') }}" method="GET" class="hidden md:block">
                        <div class="relative">
                            <input type="text" name="q" placeholder="Поиск LEGO..."
                                class="w-64 px-4 py-2 rounded-full border border-gray-200 focus:border-brickon-red focus:outline-none transition-colors">
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brickon-red">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <a href="{{ route('favorites.index') }}" class="relative group">
                        <div class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="far fa-heart text-xl text-gray-700 group-hover:text-brickon-red transition-colors"></i>
                            @php
                            $favoritesCount = auth()->check() ? auth()->user()->favorites()->count() : 0;
                            @endphp
                            @if($favoritesCount > 0)
                            <span class="absolute -top-1 -right-1 bg-brickon-red text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $favoritesCount }}
                            </span>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('cart.index') }}" class="relative group">
                        <div class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="fas fa-shopping-bag text-xl text-gray-700 group-hover:text-brickon-red transition-colors"></i>
                            @php
                            $cartCount = session('cart', []) ? array_sum(session('cart')) : 0;
                            @endphp
                            @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-brickon-red text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                                {{ $cartCount }}
                            </span>
                            @endif
                        </div>
                    </a>
                    @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-brickon-red/10 flex items-center justify-center">
                                <i class="fas fa-user text-brickon-red"></i>
                            </div>
                            <span class="hidden md:inline text-sm font-medium">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <!-- <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-user mr-2"></i> Мой профиль
                                    </a>
                                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-box mr-2"></i> Мои заказы
                                    </a> -->
                                <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-box mr-2"></i> Мои заказы
                                </a>
                                <!-- <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-user mr-2"></i> Редактировать профиль
                                    </a> -->
                                @if(Auth::user()->is_admin ?? false)
                                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-cog mr-2"></i> Админ-панель
                                </a>
                                @endif
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Выйти
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    @auth
                    @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-brickon-red transition-colors">
                        📋 Админка
                    </a>
                    @endif
                    @endauth
                    <a href="{{ route('login') }}" class="hidden md:block text-gray-600 hover:text-brickon-red transition-colors">
                        Вход
                    </a>
                    <a href="{{ route('register') }}" class="bg-brickon-red text-white px-4 py-2 rounded-full hover:bg-red-700 transition-colors text-sm font-medium">
                        Регистрация
                    </a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="md:hidden px-4 pb-3">
            <form action="{{ route('product.search') }}" method="GET">
                <div class="relative">
                    <input type="text" name="q" placeholder="Поиск LEGO..."
                        class="w-full px-4 py-2 rounded-full border border-gray-200 focus:border-brickon-red focus:outline-none">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </nav>
    <div class="pt-16"></div>

    @if(session('success'))
    <div class="fixed bottom-4 right-4 z-50 animate-slide-up">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="fixed bottom-4 right-4 z-50 animate-slide-up">
        <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="bg-brickon-black text-white mt-5 py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <i class="fas fa-cube text-brickon-red text-2xl mb-3 block"></i>
                    <h5 class="font-bold text-lg mb-3">Brickon</h5>
                    <p class="text-gray-400 text-sm">Магазин конструкторов LEGO для творческих людей всех возрастов.</p>
                </div>
                <div>
                    <h6 class="font-bold mb-3">Информация</h6>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-brickon-red transition-colors">О нас</a></li>
                        <li><a href="#" class="hover:text-brickon-red transition-colors">Доставка</a></li>
                        <li><a href="#" class="hover:text-brickon-red transition-colors">Возврат</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-bold mb-3">Категории</h6>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-brickon-red transition-colors">Technic</a></li>
                        <li><a href="#" class="hover:text-brickon-red transition-colors">City</a></li>
                        <li><a href="#" class="hover:text-brickon-red transition-colors">Star Wars</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-bold mb-3">Мы в соцсетях</h6>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-brickon-red transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-brickon-red transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-brickon-red transition-colors">
                            <i class="fab fa-telegram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2024 Brickon. Все права защищены.</p>
                <p class="mt-2 text-xs">LEGO является зарегистрированной торговой маркой LEGO Group.</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>

</html>