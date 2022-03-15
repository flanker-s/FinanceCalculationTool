<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Templates\Category;
use App\Models\Templates\Template;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Various incomes',
            'type' => 'income',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Category::create([
            'name' => 'Various expenses',
            'type' => 'expense',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if (env('APP_MODE') === 'development') {
            Category::factory()->count(10)->create();
            $category_ids = Category::all()->pluck('id');

            Template::factory()->count(50)->create([
                'category_id' => function () use ($category_ids) {
                    return $category_ids->random();
                }
            ]);
        }
    }
}
