<?php

use App\PatientManagement;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PatientManagementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Factory::create();
        foreach (range(1,5) as $index){
            PatientManagement::create([
                'code'=>$index,
                'fullName'=>$faker->userName,
                'address'=>$faker->address,
                'sex'=>rand(1,2),
                'provincialId'=>$index,
                'sourceCustomerId'=>$index
            ]);
        }
    }
}
