<?php

use App\LocationTreatment;
use Faker\Factory;
use Illuminate\Database\Seeder;

class LocationTreatmentTableSeeder extends Seeder
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
            LocationTreatment::create([
                'name'=>$faker->userName,
                'note'=>$faker->paragraph(5)
            ]);
        }
    }
}
