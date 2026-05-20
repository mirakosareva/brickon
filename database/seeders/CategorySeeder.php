<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technic', 'slug' => 'technic','image' => 'categories/category-technica.png', 'description' => 'Сложные механизмы и реалистичные модели'],
            ['name' => 'City', 'slug' => 'city', 'image' => 'categories/category-city.png', 'description' => 'Городская жизнь и транспорт'],
            ['name' => 'Harry Potter', 'slug' => 'harry-potter', 'image' => 'categories/category-hp.png', 'description' => 'Волшебный мир Гарри Поттера'],
            ['name' => 'Star Wars', 'slug' => 'star-wars', 'image' => 'categories/category-sw.png', 'description' => 'Звездные войны и космические приключения'],
            ['name' => 'Creator', 'slug' => 'creator', 'image' => 'categories/category-creator.png', 'description' => '3 в 1: три модели в одном наборе'],
        ];
        
        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']], 
                $category
            );
        }
        $this->command->info('✅ Категории успешно добавлены/обновлены!');
    }
}
