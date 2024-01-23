<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        $email = $request->email;
        $users = User::where('email', 'like', "%$email%")->get();
        return response()->json($users);
    }
}
