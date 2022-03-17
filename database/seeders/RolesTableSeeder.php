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
                'title' => 'Manager',
            ],
            [
                'id'    => 3,
                'title' => 'Storekeeper',
            ],
            [
                'id'    => 4,
                'title' => 'Processing',
            ],
            [
                'id'    => 5,
                'title' => 'Sales',
            ],
        ];

        Role::insert($roles);
    }
}
