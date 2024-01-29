<?php

namespace Database\Seeders;

use App\Models\Subsidy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubsidySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subsidies = [
            [
                'manv' => 1,
                'tenphucap' => 'phucapchucvu',
                'thang' => now()->month()
            ],
            [
                'manv' => 2,
                'tenphucap' => 'phucapkhuvuc',
                'thang' => now()->month()
            ],
            [
                'manv' => 3,
                'tenphucap' => 'phucapthamnien',
                'thang' => now()->month()
            ],
            [
                'manv' => 4,
                'tenphucap' => 'phucapdilai',
                'thang' => now()->month()
            ],
            [
                'manv' => 5,
                'tenphucap' => 'phucapthoivu',
                'thang' => now()->month()
            ],
            [
                'manv' => 6,
                'tenphucap' => 'phucapcadem',
                'thang' => now()->month()
            ],
        ];
        foreach ($subsidies as $subsidie) {
            Subsidy::create($subsidie);
        }
    }
}
