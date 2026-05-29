# Brickon — интернет-магазин LEGO конструкторов

Интернет-магазин на Laravel с полным функционалом: каталог, корзина, избранное, админ-панель, имитация оплаты.

## Технологии

- **Backend**: Laravel 13.2.0, PHP 8.3.30
- **Frontend**: Tailwind CSS
- **База данных**: MySQL
- **Аутентификация**: Laravel Breeze
- **Админ-панель**: Кастомная

## Возможности

- Регистрация и авторизация пользователей
- Каталог товаров с фильтрацией по категориям и цене
- Поиск товаров
- Добавление в избранное
- Корзина с изменением количества товаров
- Оформление заказа с вводом адреса
- Имитация оплаты (демо-режим)
- Админ-панель для управления товарами, категориями и заказами

## Установка и запуск

```bash
# Клонирование репозитория
git clone https://github.com/MiraKosareva/Brickon.git
cd brickon

# Установка зависимостей
composer install
npm install

# Настройка окружения
cp .env.example .env
php artisan key:generate

# База данных (создайте БД в phpMyAdmin и укажите в .env)
php artisan migrate --seed

# Создание ссылки для хранения изображений
php artisan storage:link

# Запуск (в двух терминалах)
npm run dev
php artisan serve
```

## Доступ к админ-панели
1. Зарегистрируйтесь на сайте (перейдите по адресу /register)
2. После регистрации откройте терминал в папке проекта и выполните:

```bash
php artisan tinker
>>> $user = User::find(1);
>>> $user->is_admin = true;
>>> $user->save();
>>> exit
```
3. Теперь перейдите на /admin — вам доступно управление товарами, категориями и заказами

## Лицензия 
MIT License

Copyright (c) 2026 Mira Kosareva

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
