<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =
            [
                [
                    'first_name' => 'bao',
                    'last_name' => 'vo',
                    'phone_number' => '0899905503',
                    'gender' => 1,
                    'address' => 'hoa tri',
                    'birth_date' => '2003-05-03',
                    'email' => 'baovo844@gmail.com',
                    'email_verified_at' => now(),
                    'password' =>  Hash::make(123456789),
                    'is_active' => true,
                    "Qualification" => 'kha',
                    'Nationality' => 'viet nam',
                    'Ethnicity' => 'kinh',
                    "Personal_Id" => '060203000996',
                    'Issue_Date' => '2020-09-09',
                    'Issued_By' => 'phu yen',
                    'Start_Date' => '2021-10-10',
                    'Language' => 'IELTS',
                    'Computer_Science' => 'B1',
                    'Permanent_Address' => 'thon long phung',
                    'Role_id' => 4,
                ],
                [
                    'first_name' => 'kiet',
                    'last_name' => 'vo',
                    'phone_number' => '0899905513',
                    'gender' => 1,
                    'address' => 'hoa tri',
                    'birth_date' => '2003-09-03',
                    'email' => 'kietvo124@gmail.com',
                    'email_verified_at' => now(),
                    'password' =>  Hash::make(123456789),
                    'is_active' => false,
                    "Qualification" => 'kha',
                    'Nationality' => 'viet nam',
                    'Ethnicity' => 'kinh',
                    "Personal_Id" => '060203000126',
                    'Issue_Date' => '2020-09-09',
                    'Issued_By' => 'phu yen',
                    'Start_Date' => '2021-10-10',
                    'Language' => 'IELTS',
                    'Computer_Science' => 'B1',
                    'Permanent_Address' => 'thon long phung',
                    'Role_id' => 3,
                ],
                [
                    'first_name' => 'dat',
                    'last_name' => 'nguyen',
                    'phone_number' => '0899905103',
                    'gender' => 1,
                    'address' => 'hoa tri',
                    'birth_date' => '2003-01-03',
                    'email' => 'datnguyen244@gmail.com',
                    'email_verified_at' => now(),
                    'password' =>  Hash::make(123456789),
                    'is_active' => false,
                    "Qualification" => 'kha',
                    'Nationality' => 'viet nam',
                    'Ethnicity' => 'kinh',
                    "Personal_Id" => '060203000999',
                    'Issue_Date' => '2020-09-09',
                    'Issued_By' => 'phu yen',
                    'Start_Date' => '2021-10-10',
                    'Language' => 'IELTS',
                    'Computer_Science' => 'A1',
                    'Permanent_Address' => 'thon long phung',
                    'Role_id' => 2,
                ],
                [
                    'first_name' => 'dat',
                    'last_name' => 'le',
                    'phone_number' => '0899915503',
                    'gender' => 1,
                    'address' => 'hoa tri',
                    'birth_date' => '2003-10-03',
                    'email' => 'datle324@gmail.com',
                    'email_verified_at' => now(),
                    'password' =>  Hash::make(123456789),
                    'is_active' => false,
                    "Qualification" => 'kha',
                    'Nationality' => 'viet nam',
                    'Ethnicity' => 'kinh',
                    "Personal_Id" => '060203000908',
                    'Issue_Date' => '2020-09-09',
                    'Issued_By' => 'phu yen',
                    'Start_Date' => '2021-10-10',
                    'Language' => 'IELTS',
                    'Computer_Science' => 'A1',
                    'Permanent_Address' => 'thon long phung',
                    'Role_id' => 1,
                ],

            ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
