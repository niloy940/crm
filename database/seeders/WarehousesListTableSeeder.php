<?php

namespace Database\Seeders;

use App\Models\WarehousesList;
use Illuminate\Database\Seeder;

class WarehousesListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouses = [
            [
            'id' => '1',
            'name' => 'Skladiste',
            ],
            [
                'id' => '2',
                'name' => 'Gotovi proizvodi',
            ],
        ];
        WarehousesList::insert($warehouses);
    }
}
