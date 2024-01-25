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
                'tenchucvu' => 'nhan vien',
            ],
            [
                'tenchucvu' => 'truong phong',
            ],
            [
                'tenchucvu' => 'pho giam doc',
            ],
            [
                'tenchucvu' => 'giam doc',
            ],
            [
                'tenchucvu' => 'chu tich',
            ],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
