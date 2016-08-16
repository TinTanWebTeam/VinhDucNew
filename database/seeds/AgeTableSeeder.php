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
            '<1',
            '1-5 ',
            '6-10',
            '11-15',
            '16-20',
            '21-25',
            '26-30',
            '31-35',
            '36-40',
            '41-45',
            '46-50',
            '51-55',
            '56-60',
            '61-65',
            '66-70',
            '71-75',
            '76-80',
            '81-85',
            '86-90',
            '91-95',
            '96-100'
        ];
        foreach (range(1, 21) as $index) {
            Age::create([
                'age' => $age[$index-1]
            ]);
        }
    }
}
