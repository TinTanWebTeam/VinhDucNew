<?php

use App\ManagementTherapist;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ManagementTherapistTableSeeder extends Seeder
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
            ManagementTherapist::create([
                'code' => 'CODE' . str_random(3) . (string) date_timestamp_get(date_create()),
                'name'=>$faker->userName,
                'sex'=>rand(1,2),
                'address'=>$faker->address,
                'provincialId'=>$index,
                'ageId'=>$index
            ]);
        }
    }
}
