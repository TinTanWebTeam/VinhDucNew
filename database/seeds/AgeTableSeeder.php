<?php

use App\Age;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $age = [
            ' < 1 ',
            '1-10 ',
            '11-20',
            '21-30',
            '31-40',
            '41-50',
            '51-60',
            '61-70',
            '71-80',
            '81-90',
            '91-100'
        ];
        foreach (range(1, 10) as $index) {
            Age::create([
                'age' => $age[$index-1]
            ]);
        }
    }
}
