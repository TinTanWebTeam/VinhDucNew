<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TreatmentPackagerTableSeeder::class);
        $this->call(PackgeTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(AgeTableSeeder::class);
        $this->call(DoctorTableSeeder::class);
        $this->call(ManagementTherapistTableSeeder::class);
        $this->call(PatientManagementTableSeeder::class);
        $this->call(TreatmentRegimensTableSeeder::class);
        $this->call(ProfessionalTreatmentTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(DiagonsesTableSeeder::class);
    }
}
