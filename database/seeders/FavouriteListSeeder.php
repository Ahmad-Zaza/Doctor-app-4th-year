<?php

namespace Database\Seeders;

use App\Models\DoctorModels\Doctor;
use App\Models\PatientModels\Patient;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FavouriteListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addFavouritePatients();
        $this->addFavouriteDoctors();
    }

    public function addFavouriteDoctors()
    {
        $patient = Patient::find(rand(1, 3));
        $doctor = Doctor::find(1);
        // $patient->favouriteDoctors()->
        DB::table('favourite_doctors')
            ->insert(['doctor_id' => $doctor->id, 'patient_id' => $patient->id]);
    }

    public function addFavouritePatients()
    {
        $doctor = Doctor::find(rand(1, 6));
        $doctor->favouritePatients()->createMany([
            [
                'id' => 2,
                'fullName' => 'Bassel Hijazi',
                'fatherName' => 'Mohammed',
                'motherName' => 'sara',
                'userName' => 'basselHi',
                'work' => 'Flutter Developper',
                'addressDetails' => 'Damascus Muhajreen',
                'phoneNumber' => 6411272,
                'nationalityID' => 65557854,
                'email' => 'bassel@gmail.com',
                'avatarID' => 1,
                'gender' => 'male',
                'bloodSymbol' => 'O+',
                'password' => Hash::make('12345678'),
                'birthday' => Carbon::createFromDate(1998, 01, 31),
                //'birthday' => Carbon::createFromDate(1998 , 01 , 31)->age,
            ],
            [
                'id' => 3,
                'fullName' => 'nour hamm',
                'fatherName' => 'Mohammed',
                'motherName' => 'yusra',
                'userName' => 'nourham',
                'work' => 'Laravel Developper',
                'addressDetails' => 'Damascus Midan',
                'phoneNumber' => 6422696,
                'nationalityID' => 855789320,
                'email' => 'nour@gmail.com',
                'avatarID' => 2,
                'gender' => 'male',
                'bloodSymbol' => 'O+',
                'password' => Hash::make('12345678'),
                'birthday' => Carbon::createFromDate(1998, 01, 31),
            ],
        ]);
    }
}
