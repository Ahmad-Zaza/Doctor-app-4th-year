<?php

namespace Database\Seeders;

use App\Models\DoctorModels\Doctor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{

    /** DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /// 1
        Doctor::create([
            'first_name' => 'ahmad',
            'last_name' => 'zaza',
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'zaza',
            'avatar' => 'images/doctor-avatar.jpg',
            'speciality_id' => 1,
            'hospital_id' => 1,
            'experience' => 3,
            'about_you' => 'I am Doctor Ahmad Zaza and I work in Al-Fayhaa hospital in Damascus',
            'picked_appointment' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /// 2
        Doctor::create([
            'first_name' => 'bassel',
            'last_name' => 'hejazi',
            'email' => 'bassel@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'bassel',
            'avatar' => 'images/doctor-avatar.jpg',
            'speciality_id' => 2,
            'hospital_id' => 2,
            'experience' => 3,
            'about_you' => 'I am Doctor Bassel and I work in Al-Shami hospital in Damascus',
            'picked_appointment' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /// 3
        Doctor::create([
            'first_name' => 'Nour',
            'last_name' => 'zaza',
            'email' => 'nour@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'nour',
            'avatar' => 'images/doctor-avatar.jpg',
            'speciality_id' => 4,
            'hospital_id' => 3,
            'experience' => 5,
            'about_you' => 'I am Doctor Nour and I work in Al-Andalus hospital in Damascus',
            'picked_appointment' => 13,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /// 4
        Doctor::create([
            'first_name' => 'Yasser',
            'last_name' => 'Fulan',
            'email' => 'Yasser@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'Yasser',
            'avatar' => 'images/doctor-avatar.jpg',
            'speciality_id' => 5,
            'hospital_id' => 4,
            'experience' => 3,
            'about_you' => 'I am Doctor Yasser and I work in Al-Mujtahed hospital in Damascus',
            'picked_appointment' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /// 5
        Doctor::create([
            'first_name' => 'Hussein',
            'last_name' => 'Fulan',
            'email' => 'hussein@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'hussein',
            'avatar' => 'images/doctor-avatar.jpg',
            'speciality_id' => 2,
            'hospital_id' => 1,
            'experience' => 3,
            'about_you' => 'I am Doctor Hussein and I work in Al-Fayhaa hospital in Damascus',
            'picked_appointment' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /// 6
        Doctor::create([
            'first_name' => 'Muhammad',
            'last_name' => 'Fulan',
            'email' => 'muhammad@gmail.com',
            'password' => Hash::make('12345678'),
            'username' => 'moo',
            'avatar' => 'images/doctor-avatar.jpg',
            'speciality_id' => 3,
            'hospital_id' => 2,
            'experience' => 1,
            'about_you' => 'I am Doctor Muhammad and I work in Al-Shami hospital in Damascus',
            'picked_appointment' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
