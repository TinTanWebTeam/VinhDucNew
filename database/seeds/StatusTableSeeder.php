<?php

use App\Status;
use Faker\Factory;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
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
            Status::create([
                'therapistCode'=>$index,
                'detailTreatmentId'=>$index
            ]);
        }
    }
}
