<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // ایجاد کاربر میزبان
        User::create([
            'name' => 'yasin',
            'email' => 'yasin@gmail.com',
            'password' => bcrypt('33333333'),
            'role_id' => 1,
        ]);
    }
}
