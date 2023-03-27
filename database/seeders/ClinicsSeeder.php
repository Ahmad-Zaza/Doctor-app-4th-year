<?php

namespace Database\Seeders;

use App\Models\DoctorModels\Clinic;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClinicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /// 1
        Clinic::create([
            'doctor_id' => 1,
             'avatar' => null,
            'address_id' => 1 ,
            'area_id' => 2 ,
            'address_details' => 'Damascus - Bab sharqi' ,
            'phone_number' => '0991855632' ,
            'open_at' => '9:00 am',
            'closed_at'=> '15:00 pm',
        ]);
        /// 2
        Clinic::create([
            'doctor_id' => 2,
            'avatar' => null,
            'address_id' => 2,
            'area_id' => 3,
            'address_details' => 'Damascus , Bab sreejeh',
            'phone_number' => '0947899325',
            'open_at' => '9:00 am',
            'closed_at'=> '15:00 pm',
        ]);
        /// 3
        Clinic::create([
            'doctor_id' => 3,
            'avatar' => null,
            'address_id' => 3,
            'area_id' => 4,
            'address_details' => 'Damascus , Bab toma',
            'phone_number' => '0991544294',
            'open_at' => '9:00 am',
            'closed_at'=> '15:00 pm',
        ]);
        /// 4
        Clinic::create([
            'doctor_id' => 4,
            'avatar' => null,
            'address_id' => 3,
            'area_id' => 1,
            'address_details' => 'Damascus , Muhajreen ',
            'phone_number' => '0999877292',
            'open_at' => '9:00 am',
            'closed_at'=> '15:00 pm',
        ]);
        /// 5
        Clinic::create([
            'doctor_id' => 5,
            'avatar' => null,
            'address_id' => 1,
            'area_id' => 5,
            'address_details' => 'Damascus , Al-mojtahed',
            'phone_number' => '0936598203',
            'open_at' => '9:00 am',
            'closed_at'=> '15:00 pm',
        ]);
    }
}
