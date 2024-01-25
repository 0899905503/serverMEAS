<?php

namespace Database\Seeders;

use App\Models\Employeediscipline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeDisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeedisciplines = [
            [
                'manv' => 1,
                'makyluat' => 1,
                'lydo' => 'tron viec',
                'ngaykyluat' => "2024-05-10"
            ],
            [
                'manv' => 2,
                'makyluat' => 1,
                'lydo' => 'tron viec',
                'ngaykyluat' => "2024-05-10"
            ],
            [
                'manv' => 3,
                'makyluat' => 2,
                'lydo' => 'tron viec',
                'ngaykyluat' => "2024-05-10"
            ],
            [
                'manv' => 4,
                'makyluat' => 2,
                'lydo' => 'tron viec',
                'ngaykyluat' => "2024-05-10"
            ],
            [
                'manv' => 5,
                'makyluat' => 2,
                'lydo' => 'tron viec',
                'ngaykyluat' => "2024-05-10"
            ],
            [
                'manv' => 6,
                'makyluat' => 1,
                'lydo' => 'tron viec',
                'ngaykyluat' => "2024-05-10"
            ],
        ];
        foreach ($employeedisciplines as $employeediscipline) {
            Employeediscipline::create($employeediscipline);
        }
    }
}
