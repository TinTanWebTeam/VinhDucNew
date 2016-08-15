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
        $key = \Config::get('app.key');
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'fullName'=>'HungLam',
            'password' => encrypt('123456',$key),
            'roleId' => 1,
            'positionId'=>random_int(1,5)
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'fullName'=>'LamHung',
            'password' => encrypt('123456',$key),
            'roleId' => 2,
            'positionId'=>random_int(1,5)
        ]);

    }
}
