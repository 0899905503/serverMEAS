<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discipline;

class DisciplineController extends Controller
{
    public function index()
    {
        $ids = Discipline::pluck('id');

        return response()->json(['discipline_ids' => $ids], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $discipline = Discipline::find($id);

        if ($discipline) {
            return response()->json(['discipline_name' => $discipline->hinhthuc], 200);
        } else {
            return response()->json(['error' => 'Discipline not found'], 404);
        }
    }
}
