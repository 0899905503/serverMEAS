<?php

namespace Database\Seeders;

use App\Models\Salaryscale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryscaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salaryscales = [
            [
                'mangach' => 1,
                'bacluong' => 'BLCB',
                'hesoluong' => 1.0,
                'manv' => 1
            ],
            [
                'mangach' => 2,
                'bacluong' => 'BLTC',
                'hesoluong' => 1.2,
                'manv' => 2
            ],
            [
                'mangach' => 3,
                'bacluong' => 'BLCN',
                'hesoluong' => 1.5,
                'manv' => 3
            ],
            [
                'mangach' => 4,
                'bacluong' => 'BLQLCT',
                'hesoluong' => 1.8,
                'manv' => 4
            ],
            [
                'mangach' => 5,
                'bacluong' => 'BLQLCC',
                'hesoluong' => 2.0,
                'manv' => 5
            ],

            [
                'mangach' => 6,
                'bacluong' => 'BLLDCC',
                'hesoluong' => 2.5,
                'manv' => 6
            ],
        ];
        foreach ($salaryscales as $salaryscale) {
            Salaryscale::create($salaryscale);
        }
    }
}
