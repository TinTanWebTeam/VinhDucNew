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
                'code'=>'CODE' . str_random(3) . (string) date_timestamp_get(date_create()),
                'fullName'=>$faker->userName,
                'address'=>$faker->address,
                'sex'=>rand(20,80),
                'weight'=>rand(40,70),
                'height'=>rand(150,180),
                'bloodPressure'=>rand(130,160),
                'provincialId'=>$index,
                'ageId'=>$index
            ]);
        }
    }
}
