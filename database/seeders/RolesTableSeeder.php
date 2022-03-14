<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Menadzer',
            ],
            [
                'id'    => 3,
                'title' => 'Magacioner',
            ],
            [
                'id'    => 4,
                'title' => 'Proizvodnja',
            ],
            [
                'id'    => 5,
                'title' => 'Prodaja',
            ],
        ];

        Role::insert($roles);
    }
}
