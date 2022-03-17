<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'              => 1,
                'name'            => 'admin',
                'email'           => 'admin@admin.com',
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
            [
                'id'              => 2,
                'name'            => 'manager',
                'email'           => 'manager@admin.com',
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
            [
                'id'              => 3,
                'name'            => 'Storekeeper',
                'email'           => 'warehouse@admin.com',
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
            [
                'id'              => 4,
                'name'            => 'Processing',
                'email'           => 'processing@admin.com',
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
            [
                'id'              => 5,
                'name'            => 'sales',
                'email'           => 'sales@admin.eu',
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
        ];

        User::insert($users);
    }
}
