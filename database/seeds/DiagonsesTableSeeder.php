<?php

use App\Diagnose;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DiagonsesTableSeeder extends Seeder
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
            Diagnose::create([
                'name' =>$faker->userName,
                'idPatientManagement'=>$index
            ]);
        }
    }
}
