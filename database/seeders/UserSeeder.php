<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'role_id' => 1,
            ],[
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => bcrypt('password'),
                'role_id' => 2,
            ]
        ]);
        User::factory(50)->create([
            'role_id' => 2,
        ]);
        User::factory(2)->create([
            'role_id' => 1,
        ]);
    }
}
