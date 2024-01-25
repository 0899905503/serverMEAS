<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        // $email = $request->email;
        // $user = User::with([
        //     ''
        // ])->find(1);
        $employee = Employee::with([
            'relative.relationship'
        ])->find(1);
        return response()->json($employee);
    }
}
