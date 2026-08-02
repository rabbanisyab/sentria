<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Gaji',
                'type' => 'income',
                'icon' => '💼',
            ],
            [
                'name' => 'Freelance',
                'type' => 'income',
                'icon' => '💻',
            ],
            [
                'name' => 'Bonus',
                'type' => 'income',
                'icon' => '🎁',
            ],
            [
                'name' => 'Investasi',
                'type' => 'income',
                'icon' => '📈',
            ],
            [
                'name' => 'Pemberian',
                'type' => 'income',
                'icon' => '❤️',
            ],
            [
                'name' => 'Others',
                'type' => 'income',
                'icon' => '💰',
            ],

            [
                'name' => 'Makanan & Minuman',
                'type' => 'expense',
                'icon' => '🍔',
            ],
            [
                'name' => 'Jajan',
                'type' => 'expense',
                'icon' => '🧋',
            ],
            [
                'name' => 'Transportasi',
                'type' => 'expense',
                'icon' => '🚌',
            ],
            [
                'name' => 'Belanja',
                'type' => 'expense',
                'icon' => '🛍️',
            ],
            [
                'name' => 'Pulsa & Internet',
                'type' => 'expense',
                'icon' => '📱',
            ],
            [
                'name' => 'Kesehatan',
                'type' => 'expense',
                'icon' => '❤️',
            ],
            [
                'name' => 'Pendidikan',
                'type' => 'expense',
                'icon' => '📚',
            ],
            [
                'name' => 'Others',
                'type' => 'expense',
                'icon' => '📦',
            ],

        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}