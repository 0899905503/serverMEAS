<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'department' => 'HR',
            ],
            [
                'department' => 'Accounting',
            ],
            [
                'department' => 'Marketing',
            ],
            [
                'department' => 'Technical',
            ],
            [
                'department' => 'Executive',
            ],
        ];
        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
