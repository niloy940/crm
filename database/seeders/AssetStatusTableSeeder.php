<?php

namespace Database\Seeders;

use App\Models\AssetStatus;
use Illuminate\Database\Seeder;

class AssetStatusTableSeeder extends Seeder
{
    public function run()
    {
        $assetStatuses = [
            [
                'id'         => 1,
                'name'       => 'Dostupno',
                'created_at' => '2022-03-09 08:02:10',
                'updated_at' => '2022-03-09 08:02:10',
            ],
            [
                'id'         => 2,
                'name'       => 'Nedostupno',
                'created_at' => '2022-03-09 08:02:10',
                'updated_at' => '2022-03-09 08:02:10',
            ],
            [
                'id'         => 3,
                'name'       => 'Pokvareno',
                'created_at' => '2022-03-09 08:02:10',
                'updated_at' => '2022-03-09 08:02:10',
            ],
            [
                'id'         => 4,
                'name'       => 'Na popravci',
                'created_at' => '2022-03-09 08:02:10',
                'updated_at' => '2022-03-09 08:02:10',
            ],
        ];

        AssetStatus::insert($assetStatuses);
    }
}
