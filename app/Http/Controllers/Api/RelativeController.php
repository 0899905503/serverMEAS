<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Relative;
use App\Models\Relationship;

class RelativeController extends Controller
{
    public function getRelativesAndRelationships($userId)
    {
        $relationships = Relationship::where('manv', $userId)->get();

        if ($relationships->isEmpty()) {
            return response()->json(['message' => 'Employee not found or has no relatives'], 404);
        }

        $relativeIds = $relationships->pluck('matn')->toArray();

        $relatives = Relative::whereIn('id', $relativeIds)->get();

        $result = [];

        foreach ($relatives as $relative) {
            $relativeData = [
                'relative_info' => $relative,
                'relationships' => $relationships->where('matn', $relative->id)->pluck('loaiquanhe')->toArray(),
            ];

            $result[] = $relativeData;
        }

        return response()->json(['employee_id' => $userId, 'relatives' => $result]);
    }
    public function getRelative()
    {
        $relative = Relative::all();
        return response()->json(['relatives' => $relative], 200);
    }
    public function getRelationship()
    {
        $relation = Relationship::all();
        return response()->json(['relatives' => $relation], 200);
    }
}
