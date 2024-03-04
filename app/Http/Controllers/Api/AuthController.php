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

// class AuthController extends Controller
// {
//     //
//     public function signup(Request $request)
//     {
//         //validate
//         $request->validate(
//             [
// 'email' => 'required|string|unique:users',
// 'password' => 'required|string|min:8',
// 'first_name' => 'required|string',
// 'last_name' => 'required|string',
// 'phone_number' => 'required',
// 'gender' => 'required',
// 'is_active' => 'required',
// 'address' => 'required'

//             ]
//         );
//         // if ($request->fails()) {
//         //     return response()->json($request->errors(), 400);
//         // }
//         $user = User::create([
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'first_name' => $request->first_name,
//             'last_name' => $request->last_name,
//             'phone_number' => $request->phone_number,
//             'gender' => $request->gender,
//             'is_active' => $request->is_active,
//             'birth_date' => now(),
//             'address' => $request->address
//         ]);

// $token = $user->createToken('Personal access token')->plainTextToken;
// $response = ['user' => $user, 'token' => $token];
//         return response()->json($response, 200);
//     }

//     function signin(Request $request)
//     {
//         $user = User::where('email', $request->email)->first();

//         if (Auth::attempt($request->only(['email', 'password']))) {
// $token = $user->createToken('Pesonal Access Token')->plainTextToken;
// $response = ['status' => 200, 'token' => $token, 'user' => $user, 'message' => 'Successfully Login!'];
// return response()->json($response);
//         } else if ($user == '[]') {
//             $response = ['status' => 500, 'message' => 'No account found with this email!'];
//             return response()->json($response);
//         } else {
//             $response = ['status' => 500, 'message' => 'Email or Password incorrect!'];
//             return response()->json($response);
//         }
//     }
// }
class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
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

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

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

            return response()->json([
                $token = $user->createToken('Personal access token')->plainTextToken,
                $response = ['user' => $user, 'token' => $token],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                $token = $user->createToken('Pesonal Access Token')->plainTextToken,
                $response = ['status' => 200, 'token' => $token, 'user' => $user, 'message' => 'Successfully Login!'],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
