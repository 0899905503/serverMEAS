<?php

namespace App\Http\Controllers\Api;



use App\Models\Employeediscipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


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
}
