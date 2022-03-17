<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Templates\Category;
use App\Models\Templates\Template;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

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

        Category::factory()->count(10)->create();
        $category_ids = Category::all()->pluck('id');

        Template::factory()->count(50)->create([
            'category_id' => function () use ($category_ids) {
                return $category_ids->random();
            },
        ]);
    }
}
