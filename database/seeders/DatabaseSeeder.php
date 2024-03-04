<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Discipline;
use App\Models\Salaryscale;
use App\Models\Subsidy;
use Illuminate\Database\Seeder;
use Termwind\Components\Raw;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                RelativeSeeder::class,
                RelationshipSeeder::class,
                DisciplineSeeder::class,
                EmployeeDisciplineSeeder::class,
                RankSeeder::class,
                RoleSeeder::class,
                SalaryscaleSeeder::class,
                SubsidySeeder::class,
                UserSeeder::class
            ]
        );
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
