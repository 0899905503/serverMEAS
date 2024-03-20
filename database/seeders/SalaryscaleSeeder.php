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
                'bacluong' => 1,
                'hesoluong' => 1.0,
                'manv' => 21,
                'luongtheobac' => 7500000
            ],
            [
                'mangach' => 2,
                'bacluong' => 2,
                'hesoluong' => 1.2,
                'manv' => 25,
                'luongtheobac' => 7500000
            ],
            [
                'mangach' => 3,
                'bacluong' => 3,
                'hesoluong' => 1.5,
                'manv' => 8,
                'luongtheobac' => 7500000
            ],
            [
                'mangach' => 4,
                'bacluong' => 4,
                'hesoluong' => 1.8,
                'manv' => 4, 'luongtheobac' => 7500000

            ],
            [
                'mangach' => 5,
                'bacluong' => 5,
                'hesoluong' => 2.0,
                'manv' => 3,
                'luongtheobac' => 7500000
            ],

            [
                'mangach' => 6,
                'bacluong' => 6,
                'hesoluong' => 2.5,
                'manv' => 2,
                'luongtheobac' => 7500000
            ],
        ];
        foreach ($salaryscales as $salaryscale) {
            Salaryscale::create($salaryscale);
        }
    }
}
