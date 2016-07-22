<?php


use App\Package;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PackgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Factory::create();
        foreach (range(1,5) as $index){
            Package::create([
               'name'=>$faker->name,
                'note'=>$faker->paragraph(5),
                'treatmentPackageId'=>$index
            ]);
        }
    }
}
