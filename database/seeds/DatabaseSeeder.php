<?php

use App\Admin;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'password'=> bcrypt('aaaaaa'),
        ]);
    }
}
