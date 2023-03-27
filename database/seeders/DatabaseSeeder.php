<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            DoctorSeeder::class,
            ClinicsSeeder::class,
            HospitalSeeder::class,
            SpecialitySeeder::class,
            AreaSeeder::class,
            AddressSeeder::class,
            PatientDrugSeeder::class,
            FavouriteListSeeder::class,
        ]);
    }
}
