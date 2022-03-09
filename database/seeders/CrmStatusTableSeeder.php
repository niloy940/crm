<?php

namespace Database\Seeders;

use App\Models\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [
            [
                'id'         => 1,
                'name'       => 'Kupac',
                'created_at' => '2022-03-09 08:01:55',
                'updated_at' => '2022-03-09 08:01:55',
            ],
            [
                'id'         => 2,
                'name'       => 'Dobavljac',
                'created_at' => '2022-03-09 08:01:55',
                'updated_at' => '2022-03-09 08:01:55',
            ],
            [
                'id'         => 3,
                'name'       => 'Partner',
                'created_at' => '2022-03-09 08:01:55',
                'updated_at' => '2022-03-09 08:01:55',
            ],
        ];

        CrmStatus::insert($crmStatuses);
    }
}
