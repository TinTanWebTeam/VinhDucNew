<?php

use App\Provinces;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
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
            Provinces::create([
                'name'=>$faker->userName
            ]);
        }
    }
}
