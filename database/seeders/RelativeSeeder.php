<?php

namespace Database\Seeders;

use App\Models\Relative;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relatives = [
            [
                'hotentn' => 'nguyen van a',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'long phung',
            ],
            [
                'hotentn' => 'nguyen van b',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'long phung',
            ],
            [
                'hotentn' => 'nguyen van c',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'long phung',
            ],
            [
                'hotentn' => 'nguyen van d',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'long phung',
            ],
            [
                'hotentn' => 'nguyen van e',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'long phung',
            ],
        ];
        foreach ($relatives as $relative) {
            Relative::create($relative);
        }
    }
}
