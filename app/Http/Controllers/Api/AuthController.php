<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function signup(Request $request)
    {
        //validate
        $request->validate(
            [
                'email' => 'required|string|unique:users',
                'password' => 'required|string|min:8',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone_number' => 'required',
                'gender' => 'required',
                'is_active' => 'required',
                'address' => 'required'

            ]
        );
        // if ($request->fails()) {
        //     return response()->json($request->errors(), 400);
        // }
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'is_active' => $request->is_active,
            'birth_date' => now(),
            'address' => $request->address
        ]);

        $token = $user->createToken('Personal access token')->plainTextToken;
        $response = ['user' => $user, 'token' => $token];
        return response()->json($response, 200);
    }
    //
    // public function signin(Request $request)
    // {
    //     $rules = [
    //         'email' => 'required',
    //         'password' => 'required|string'
    //     ];
    //     $request->validate($rules);

    //     $user = User::where('email', $request->email)->first();

    //     if ($user && Hash::check($request->password, $user->password)) {
    //         $token = $user->createToken('Personal access token')->plainTextToken;
    //         $response = ['user' => $user, 'token' => $token];
    //         return response()->json($request, 200);
    //     }

    //     $response = ['message' => 'incorrect email or password'];
    //     return response()->json($response, 400);
    // }

    // function signup(Request $request)
    // {
    //     try {
    //         $cred = new User();
    //         $cred->first_name = $request->first_name;
    //         $cred->email = $request->email;
    //         $cred->password = Hash::make($request->password);
    //         $cred->save();
    //         $response = ['status' => 200, 'message' => 'Register Successfully!'];
    //         return response()->json($response);
    //     } catch (Exception $e) {
    //         $response = ['status' => 500, 'message' => $e];
    //     }
    // }
    function signin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user != [] && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Pesonal Access Token')->plainTextToken;
            $response = ['status' => 200, 'token' => $token, 'user' => $user, 'message' => 'Successfully Login!'];
            return response()->json($response);
        } else if ($user == '[]') {
            $response = ['status' => 500, 'message' => 'No account found with this email!'];
            return response()->json($response);
        } else {
            $response = ['status' => 500, 'message' => 'Email or Password incorrect!'];
            return response()->json($response);
        }
    }
}
