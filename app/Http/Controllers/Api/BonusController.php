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
}
