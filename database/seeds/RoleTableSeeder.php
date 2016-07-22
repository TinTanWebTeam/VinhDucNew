<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'description' => 'Tài khoản quản trị'
        ]);
     
        Role::create([
            'name' => 'user',
            'description' => 'Tài khoản người dùng'
        ]);
    }
}
