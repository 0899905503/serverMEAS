<?php

namespace Database\Seeders;

use App\Models\Relationship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relationships = [
            [
                'manv' => 1,
                'matn' => 1,
                'loaiquanhe' => 'cha de'
            ],
            [
                'manv' => 2,
                'matn' => 2,
                'loaiquanhe' => 'me de'
            ],
            [
                'manv' => 3,
                'matn' => 3,
                'loaiquanhe' => 'anh'
            ],
            [
                'manv' => 4,
                'matn' => 4,
                'loaiquanhe' => 'chi'
            ],
            [
                'manv' => 5,
                'matn' => 5,
                'loaiquanhe' => 'em'
            ],

        ];
        foreach ($relationships as $relationship) {
            Relationship::create($relationship);
        }
    }
}
