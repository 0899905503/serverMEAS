<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $employees = [
            [
                'tennv' => 'baovo',
                'gioitinh' => 'nam',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'phu hoa',
                'sdt' => '0899905503',
                'trinhdo' => 'kha',
                'quoctich' => 'viet nam',
                'dantoc' => 'kinh',
                'cccd' => '060203000996',
                'ngaycap' => '2020-09-09',
                'noicap' => 'phu yen',
                'ngayvaolam' => '2021-10-10',
                'ngoaingu' => 'IELTS',
                'tinhoc' => 'B1',
                'diachithuongtru' => 'thon long phung',

            ],
            [
                'tennv' => 'anhvo',
                'gioitinh' => 'nam',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'phu hoa',
                'sdt' => '0899905503',
                'trinhdo' => 'kha',
                'quoctich' => 'viet nam',
                'dantoc' => 'kinh',
                'cccd' => '060203000996',
                'ngaycap' => '2020-09-09',
                'noicap' => 'phu yen',
                'ngayvaolam' => '2021-10-10',
                'ngoaingu' => 'IELTS',
                'tinhoc' => 'B1',
                'diachithuongtru' => 'thon long phung',

            ],
            [
                'tennv' => 'tuyen',
                'gioitinh' => 'nam',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'phu hoa',
                'sdt' => '0899905503',
                'trinhdo' => 'kha',
                'quoctich' => 'viet nam',
                'dantoc' => 'kinh',
                'cccd' => '060203000996',
                'ngaycap' => '2020-09-09',
                'noicap' => 'phu yen',
                'ngayvaolam' => '2021-10-10',
                'ngoaingu' => 'IELTS',
                'tinhoc' => 'B1',
                'diachithuongtru' => 'thon long phung',

            ],
            [
                'tennv' => 'kieu',
                'gioitinh' => 'nam',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'phu hoa',
                'sdt' => '0899905503',
                'trinhdo' => 'kha',
                'quoctich' => 'viet nam',
                'dantoc' => 'kinh',
                'cccd' => '060203000996',
                'ngaycap' => '2020-09-09',
                'noicap' => 'phu yen',
                'ngayvaolam' => '2021-10-10',
                'ngoaingu' => 'IELTS',
                'tinhoc' => 'B1',
                'diachithuongtru' => 'thon long phung',

            ],
            [
                'tennv' => 'van',
                'gioitinh' => 'nam',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'phu hoa',
                'sdt' => '0899905503',
                'trinhdo' => 'kha',
                'quoctich' => 'viet nam',
                'dantoc' => 'kinh',
                'cccd' => '060203000996',
                'ngaycap' => '2020-09-09',
                'noicap' => 'phu yen',
                'ngayvaolam' => '2021-10-10',
                'ngoaingu' => 'IELTS',
                'tinhoc' => 'B1',
                'diachithuongtru' => 'thon long phung',

            ],
            [
                'tennv' => 'thuong',
                'gioitinh' => 'nam',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'phu hoa',
                'sdt' => '0899905503',
                'trinhdo' => 'kha',
                'quoctich' => 'viet nam',
                'dantoc' => 'kinh',
                'cccd' => '060203000996',
                'ngaycap' => '2020-09-09',
                'noicap' => 'phu yen',
                'ngayvaolam' => '2021-10-10',
                'ngoaingu' => 'IELTS',
                'tinhoc' => 'B1',
                'diachithuongtru' => 'thon long phung',

            ],
            [
                'tennv' => 'ngoc',
                'gioitinh' => 'nam',
                'ngaysinh' => '2003-05-03',
                'diachi' => 'phu hoa',
                'sdt' => '0899905503',
                'trinhdo' => 'kha',
                'quoctich' => 'viet nam',
                'dantoc' => 'kinh',
                'cccd' => '060203000996',
                'ngaycap' => '2020-09-09',
                'noicap' => 'phu yen',
                'ngayvaolam' => '2021-10-10',
                'ngoaingu' => 'IELTS',
                'tinhoc' => 'B1',
                'diachithuongtru' => 'thon long phung',

            ],
        ];
        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
