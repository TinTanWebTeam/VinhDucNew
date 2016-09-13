<?php

use App\DetailedTreatment;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DetailedTreatmentTableSeeder extends Seeder
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
            DetailedTreatment::create([
                'name' =>$faker->userName,
                'treatmentPackageId'=>$index,
                'professionalTreatment'=>$faker->name,
                'location'=>$faker->name,
                'patientId'=>$index,
//                'therapistId'=>$index
            ]);
        }
    }
}
