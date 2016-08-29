<?php

use App\SourceCustomer;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SourceCustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1, 5) as $index) {
            SourceCustomer::create([
                'sourceCustomer' => $faker->name
            ]);
        }
    }
}
