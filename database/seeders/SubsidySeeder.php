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

                'tenphucap' => 'phucapchucvu',
                'thang' => now()->month()
            ],
            [

                'tenphucap' => 'phucapkhuvuc',
                'thang' => now()->month()
            ],
            [

                'tenphucap' => 'phucapthamnien',
                'thang' => now()->month()
            ],
            [

                'tenphucap' => 'phucapdilai',
                'thang' => now()->month()
            ],
            [

                'tenphucap' => 'phucapthoivu',
                'thang' => now()->month()
            ],
            [

                'tenphucap' => 'phucapcadem',
                'thang' => now()->month()
            ],
        ];
        foreach ($subsidies as $subsidie) {
            Subsidy::create($subsidie);
        }
    }
}
