<?php

use App\InformationSurveys;
use Faker\Factory;
use Illuminate\Database\Seeder;

class InformationSurveysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1,5) as $index){
            InformationSurveys::create([
                'createdDate'=> date('Y-m-d'),
                'patientReviews'=>"Tra loi".$index,
                'content'=>"Cau hoi".$index,
                'handling'=>random_int(1,2),
                'patient_id'=> $index,
            ]);
        }
    }
}
