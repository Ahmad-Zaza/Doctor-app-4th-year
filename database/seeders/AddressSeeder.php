<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /// 1
        Address::create([
            'name' => 'Muhajreen'
        ]);
        /// 2
        Address::create([
            'name' => 'Bab Sharqi'
        ]);
        /// 3
        Address::create([
            'name' => 'Bab Sreejeh'
        ]);
        /// 4
        Address::create([
            'name' => 'Bab Toma'
        ]);
        /// 5
        Address::create([
            'name' => 'Al Mujtahed'
        ]);
    }
}
