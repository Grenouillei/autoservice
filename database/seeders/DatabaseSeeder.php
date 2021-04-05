<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Currency::factory(1)->create();
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'admin' => true,
        ]);
        $this->call([
            UserTableSeeder::class,
            GoodTableSeeder::class,
            UserCommentsTableSeeder::class,
        ]);
    }
}
