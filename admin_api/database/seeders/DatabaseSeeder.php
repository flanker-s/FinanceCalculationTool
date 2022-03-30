<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Templates\Operation;
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

        $income = Operation::create([
            'name' => 'income'
        ]);
        $expense = Operation::create([
            'name' => 'expense'
        ]);

        Category::create([
            'name' => 'Various incomes',
            'isPrimary' => true,
            'operation_id' => $income->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        Category::create([
            'name' => 'Various expenses',
            'isPrimary' => true,
            'operation_id' => $expense->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $operation_ids = Operation::all()->pluck('id');
        Category::factory()->count(10)->create([
            'operation_id' => function () use ($operation_ids) {
                return $operation_ids->random();
            }
        ]);

        $category_ids = Category::all()->pluck('id');
        Template::factory()->count(50)->create([
            'category_id' => function () use ($category_ids) {
                return $category_ids->random();
            },
        ]);
    }
}
