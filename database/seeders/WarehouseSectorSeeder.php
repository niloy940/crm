<?php

namespace Database\Seeders;

use App\Models\WarehouseSector;
use Illuminate\Database\Seeder;

class WarehouseSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WarehouseSector::create(['name' => 'Some Sector']);
    }
}
