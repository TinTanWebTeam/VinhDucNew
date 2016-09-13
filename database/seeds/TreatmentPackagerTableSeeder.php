<?php

use App\TreatmentPackage;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TreatmentPackagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Factory::create();
        $name=[
            'goi sieu am',
            'goi phu san',
            'goi tri lieu',
            'goi cham soc dac biet',
            'goi Vip',
            'goi khac'
        ];
        foreach (range(1,5) as $index){
            TreatmentPackage::create([
                'code'=>'MP' . str_random(3) . (string) date_timestamp_get(date_create()),
                'name' => $name[$index],
                'note' => $faker->paragraph(5),
                'patientId'=>$index
            ]);
        }
        
    }
}
