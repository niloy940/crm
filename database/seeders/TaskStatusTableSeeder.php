<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusTableSeeder extends Seeder
{
    public function run()
    {
        $taskStatuses = [
            [
                'id'   => 1,
                'name' => 'Otvoreno',
            ],
            [
                'id'   => 2,
                'name' => 'U toku',
            ],
            [
                'id'   => 3,
                'name' => 'Zavrseno',
            ],
        ];

        TaskStatus::insert($taskStatuses);
    }
}
