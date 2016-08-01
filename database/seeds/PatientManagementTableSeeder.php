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
        $sex=[
            'Nam',
            'Nữ',
        ];
        foreach (range(1,5) as $index){
            PatientManagement::create([
                'code'=>'BN' . str_random(3) . (string) date_timestamp_get(date_create()),
                'fullName'=>$faker->userName,
                'address'=>$faker->address,
                'sex'=>$sex[rand(0,count($sex)-1)],
                'weight'=>rand(40,70),
                'height'=>rand(150,180),
                'bloodPressure'=>rand(130,160),
                'provincialId'=>$index,
                'ageId'=>$index
            ]);
        }
    }
}
