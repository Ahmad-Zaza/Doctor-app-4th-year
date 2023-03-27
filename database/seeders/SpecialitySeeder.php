<?php

namespace Database\Seeders;

use App\Models\DoctorModels\Speciality;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /// 1
        Speciality::create([
            'title' => 'Internal medicine'
        ]);
        /// 2
        Speciality::create([
            'title' => 'Orthopedic'
        ]);
        /// 3
        Speciality::create([
            'title' => 'Neurologist'
        ]);
        /// 4
        Speciality::create([
            'title' => 'pediatrician'
        ]);
        /// 5
        Speciality::create([
            'title' => 'Ophthalmic'
        ]);
    }
}
