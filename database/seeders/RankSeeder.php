<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [
            [
                'tenngach' => 'nhanvien'
            ],
            [
                'tenngach' => 'phoquanly'
            ],
            [
                'tenngach' => 'quanly'
            ],
            [
                'tenngach' => 'phogiamdoc'
            ],
            [
                'tenngach' => 'giamdoc'
            ],
            [
                'tenngach' => 'phochutich'
            ],
            [
                'tenngach' => 'chutich'
            ],
        ];
        foreach ($ranks as $rank) {
            Rank::create($rank);
        }
    }
}
