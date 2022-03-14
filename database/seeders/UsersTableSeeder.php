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
                'name'            => 'Dejan Cicovic',
                'email'           => 'dejan.cicovic@gmail.com',
                'password'        => bcrypt('Banana01'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
            [
                'id'              => 2,
                'name'            => 'Olga Lisicic',
                'email'           => 'olgica@parenasunce.com',
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
            [
                'id'              => 3,
                'name'            => 'Novak Mladenovic',
                'email'           => 'noledg@gmail.com',
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
            [
                'id'              => 4,
                'name'            => 'Marko Ivanovic',
                'email'           => 'pekar@gmail.com',
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
            [
                'id'              => 5,
                'name'            => 'Zelimir Ivanovic',
                'email'           => 'sales@myspoon.eu',
                'password'        => bcrypt('password'),
                'remember_token'  => null,
                'two_factor_code' => '',
            ],
        ];

        User::insert($users);
    }
}
