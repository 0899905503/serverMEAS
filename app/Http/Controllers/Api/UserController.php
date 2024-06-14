<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserInfo()
    {
        $user = request()->user();
        return $user;
    }
    public function getAllUser()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }
    public function getUserById($id)
    {
        $employee = User::find($id);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }

        return response()->json(['employee' => $employee], 200);
    }
    public function getAllEmployeeIds()
    {
        $employeeIds = User::pluck('id');

        return response()->json(['employee_ids' => $employeeIds], 200);
    }
}
