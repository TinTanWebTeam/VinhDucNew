<?php

use App\Doctor;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DoctorTableSeeder extends Seeder
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
            Doctor::create([
                'code' =>'CODE' . str_random(3) . (string) date_timestamp_get(date_create()),
                'name'=>$faker->userName,
                'reference'=>$index,
                'note'=>$faker->paragraph(5),
                'provincialId'=>$index
            ]);
        }
    }
}
