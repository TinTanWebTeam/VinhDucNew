<?php

use App\TreatmentRegimen;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TreatmentRegimensTableSeeder extends Seeder
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
            TreatmentRegimen::create([
                'code'=>'CODE' . str_random(3) . (string) date_timestamp_get(date_create()),
                'patientId'=>$index
            ]);
        }
    }
}
