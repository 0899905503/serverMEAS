<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'manv' => '1',
                'tenchucvu' => 'nhan vien',
            ],
            [
                'manv' => '2',
                'tenchucvu' => 'truong phong',
            ],
            [
                'manv' => '3',
                'tenchucvu' => 'pho giam doc',
            ],
            [
                'manv' => '4',
                'tenchucvu' => 'giam doc',
            ],
            [
                'manv' => '5',
                'tenchucvu' => 'chu tich',
            ],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
