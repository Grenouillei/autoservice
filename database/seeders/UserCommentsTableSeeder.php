<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserComment::factory(12)->create();
    }
}
