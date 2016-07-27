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
        $sex=[
            'Nam',
            'Nữ'
        ];
        foreach (range(1, 5) as $index) {
            ManagementTherapist::create([
                'code' => 'CODE' . str_random(3) . (string) date_timestamp_get(date_create()),
                'name'=>$faker->userName,
                'sex'=>$sex[rand(0,count($sex)-1)],
                'address'=>$faker->address,
                'provincialId'=>$index,
                'ageId'=>$index
            ]);
        }
    }
}
