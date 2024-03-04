<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class RoleController extends Controller
{
    public function getRoleById($id)
    {
        $employeeRole = User::with('role')->find($id);

        if (!$employeeRole) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }

        return response()->json(['employeeRole' => $employeeRole], 200);
    }
}
