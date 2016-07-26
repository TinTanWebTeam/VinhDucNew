<?php

use App\ProfessionalTreatment;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProfessionalTreatmentTableSeeder extends Seeder
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
            ProfessionalTreatment::create([
                'name'=>$faker->userName,
                'note'=>$faker->paragraph(5),
                'locationTreatmentId'=>random_int(1,5)
            ]);
        }
    }
}
