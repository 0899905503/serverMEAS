<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getEmployeeInfo($employeeId)
    {
        try {
            $employee = Employee::findOrFail($employeeId);
            return response()->json(['success' => true, 'data' => $employee], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
