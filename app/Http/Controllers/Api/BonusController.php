<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bonus;
use App\Models\EmployeeBonus;
use Illuminate\Support\Facades\Validator;

class BonusController extends Controller
{

    // Phương thức để gán khen thưởng cho nhân viên
    public function createEmployeeBonus(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'manv' => 'required|exists:users,id',
            'makhenthuong' => 'required|exists:bonus,id',
            'lydo' => 'required|string|max:255',
            'ngaykhenthuong' => 'required|date',
            'tienthuong' => 'nullable|numeric' // Thêm dòng này
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create new Employeediscipline record
        $bonus = EmployeeBonus::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Employee bonus created successfully',
            'data' => $bonus
        ], 201);
    }
    public function index()
    {
        $ids = Bonus::pluck('id');

        return response()->json(['bonus_ids' => $ids], 200);
    }
    public function show($id)
    {
        $bonus = Bonus::find($id);

        if ($bonus) {
            return response()->json(['bonus_name' => $bonus->hinhthuc], 200);
        } else {
            return response()->json(['error' => 'Discipline not found'], 404);
        }
    }
    public function showBonusesByMonth($month, $year)
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

        $bonuses = EmployeeBonus::whereYear(
            'ngaykhenthuong',
            $year
        )
            ->whereMonth('ngaykhenthuong', $month)
            ->get();

        if ($bonuses->isEmpty()) {
            return response()->json(['error' => 'No bonuses found for the specified month and year'], 404);
        }

        return response()->json($bonuses, 200);
    }

    public function showBonusesByEmployeeId($id)
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

        $bonuses = EmployeeBonus::where('manv', $id)->get();

        if ($bonuses->isEmpty()) {
            return response()->json(['error' => 'No bonuses found for the specified employee ID'], 404);
        }

        return response()->json($bonuses, 200);
    }
}
