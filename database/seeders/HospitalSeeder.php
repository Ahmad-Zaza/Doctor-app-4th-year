<?php

namespace Database\Seeders;

use App\Models\DoctorModels\Hospital;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /// 1
        Hospital::create([
            'name' => 'Al-Fayhaa'
        ]);
        /// 2
        Hospital::create([
            'name' => 'Al-Shami'
        ]);
        /// 3
        Hospital::create([
            'name' => 'Al-Andalus'
        ]);
        /// 4
        Hospital::create([
            'name' => 'Al-Mujtahed'
        ]);

    }
}
