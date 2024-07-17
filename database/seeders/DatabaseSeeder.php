<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Customer;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);

        Category::create([
            'name' => 'makanan'
        ]);

        Customer::create([
            'name' => 'John Smith',
            'email' => 'john@gmail.com',
            'phone' => '+818833222'
        ]);

        PaymentMethod::create([
            'name' => 'Cash',
            'description' => 'Cash Description',
            'status' => 'active'
        ]);


        Menu::create([
            'name' => 'apel',
            'price' => '10000',
            'description' => 'ini apel.',
            'image' => 'C9T9OXZ5mgmtOBq1oxivF90slIFNZXA0hyNSqcDB',
            'category_id' => '1'
        ]);
    }
}
