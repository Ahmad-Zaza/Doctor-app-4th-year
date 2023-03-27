<?php

namespace Database\Seeders;

use App\Models\PatientModels\Patient;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientDrugSeeder extends Seeder
{
    private $patient;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this -> addPatient();
        $this -> addPermanents();
        $this -> addAllergens();
    }

    public function addPatient(){
        $this->patient =  Patient::create([
            'id' => 1,
            'fullName' => 'Ahmad Zaza',
            'fatherName' => 'Emad',
            'motherName' => 'Amal',
            'password' => Hash::make('12345678'),
            'phoneNumber' => 6434444,
            'nationalityID' => 00332256,
            'email' => 'ahmad@gmail.com',
            'userName' => 'zaza98',
            'work' => 'Back-End Developer',
            'avatarID' => 1,
            'gender' => 'male',
            'bloodSymbol' => 'O+',
            'addressDetails' => 'Damascus Syria',
            'birthday' => Carbon::createFromDate(1998 , 01 , 31),
        ]);
    }
    public function addPermanents()
    {
        $this->patient->permanentDrugs()->createMany([
            [
                'name' => 'sytamol',
                'price' => '1500sp',
                'company' => 'parasytamol',
                'scientificName' => 'aspirirnePermanent1',
            ],

            [
                'name' => 'permanent1',
                'price' => '2500sp',
                'company' => 'parasytamol',
                'scientificName' => 'aspirirnePermanent2',
            ],

            [
                'name' => 'permanent2',
                'price' => '8500sp',
                'company' => 'parasytamol',
                'scientificName' => 'aspirirnePermanent3',
            ]
        ]);
    }
    public function addAllergens()
    {
        $this->patient->allergensDrugs()->createMany([
            [
                'name' => 'allergen1',
                'price' => '1500sp',
                'company' => 'parasytamol',
                'scientificName' => 'aspirirneAllergen1',
            ],
            [
                'name' => 'allergen2',
                'price' => '11000sp',
                'company' => 'parasytamol',
                'scientificName' => 'aspirirneAllergen2',
            ],
        ]);
    }
}
