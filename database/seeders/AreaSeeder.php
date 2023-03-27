<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /// 1
        Area::create([
            'name' => 'jaddeh5',
            'address_id' => 1,
        ]);
        /// 2
        Area::create([
            'name' => 'Kemaryeah',
            'address_id' => 2,
        ]);
        /// 3
        Area::create([
            'name' => 'Share3-Khalid',
            'address_id' => 3,
        ]);
        /// 4
        Area::create([
            'name' => 'Kassa3',
            'address_id' => 4,
        ]);
        /// 5
        Area::create([
            'name' => 'Mujtahed-Kurneesh',
            'address_id' => 5,
        ]);
    }
}
