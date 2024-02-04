<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        //validate
        $rules = [
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
            'first_name' => 'required|string',
        ];
        $validtor = Validator::make($request->all(), $rules);
        if ($validtor->fails()) {
            return response()->json($validtor->errors(), 400);
        }
        $user = User::create([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('Personal access token')->plainTextToken;
        $respone = ['user' => $user, 'token' => $token];
        return response()->json($respone, 200);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required|string'
        ];
        $request->validate($rules);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Personal access token')->plainTextToken;
            $respone = ['user' => $user, 'token' => $token];
            return response()->json($request, 200);
        }

        $respone = ['message' => 'incorrect email or password'];
        return response()->json($respone, 400);
    }
}
