<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'fullName'=>'HungLam',
            'password' => crypt(Config::get('app.key'),'tintansoft'),
            'roleId' => 1,
            'positionId'=>random_int(1,5)
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'fullName'=>'LamHung',
            'password' => crypt(Config::get('app.key'),'tintansoft'),
            'roleId' => 2,
            'positionId'=>random_int(1,5)
        ]);

    }
}
