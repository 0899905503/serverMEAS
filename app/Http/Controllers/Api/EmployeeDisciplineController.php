<?php

namespace App\Http\Controllers\Api;



use App\Models\Employeediscipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Database\Seeders\EmployeeDisciplineSeeder;

class EmployeeDisciplineController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'manv' => 'required|exists:users,id',
            'makyluat' => 'required|exists:disciplines,id',
            'lydo' => 'required|string|max:255',
            'ngaykyluat' => 'required|date',
            'tienphat' => 'nullable|numeric' // Thêm dòng này
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create new Employeediscipline record
        $discipline = Employeediscipline::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Employee discipline created successfully',
            'data' => $discipline
        ], 201);
    }
    public function showDisciplinesByMonth($month, $year)
    {
        $validator = Validator::make(['month' => $month, 'year' => $year], [
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:' . date('Y')
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $bonuses = Employeediscipline::whereYear(
            'ngaykyluat',
            $year
        )
            ->whereMonth('ngaykyluat', $month)
            ->get();

        if ($bonuses->isEmpty()) {
            return response()->json(['error' => 'No disciplines found for the specified month and year'], 404);
        }

        return response()->json($bonuses, 200);
    }
    public function showDisciplinesByEmployeeId($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $bonuses = EmployeeDiscipline::where('manv', $id)->get();

        if ($bonuses->isEmpty()) {
            return response()->json(['error' => 'No disciplines found for the specified employee ID'], 404);
        }

        return response()->json($bonuses, 200);
    }
}
