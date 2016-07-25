<?php

use App\position;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder
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
            Position::create([
                'name'=>$faker->userName,
            ]);
        }
    }
}
