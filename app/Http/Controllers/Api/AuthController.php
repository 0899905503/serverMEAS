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
                    'Personal_id' => 'required',
                    'email' => 'required|string|unique:users',
                    'password' => 'required|string|min:8',
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'phone_number' => 'required',
                    'gender' => 'required',
                    'is_active' => 'required',
                    'address' => 'required',
                    'Nationality' => 'required',
                    'Ethnicity' => 'required',
                    'Religion' => 'required',
                    'Issue_Date' => 'required',
                    'Issued_By' => 'required',
                    'Start_Date' => 'required',
                    'Language' => 'required',
                    'Computer_Science' => 'required',
                    'Permanent_Address' => 'required',
                    'avatar' => 'required',
                    'Role_id' => 'required',
                    "Qualification" => 'required'
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
                'Personal_id' => $request->Personal_id,
                'Qualification' => $request->Qualification,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'is_active' => $request->is_active,
                'birth_date' => now(),
                'address' => $request->address,
                'Nationality' => $request->Nationality,
                'Ethnicity' => $request->Ethnicity,
                'Religion' => $request->Religion,
                'Issue_Date' => $request->Issue_Date,
                'Issued_By' => $request->Issued_By,
                'Start_Date' => $request->Start_Date,
                'Language' => $request->Language,
                'Computer_Science' => $request->Computer_Science,
                'Permanent_Address' => $request->Permanent_Address,
                'avatar' => $request->avatar,
                'Role_id' => $request->Role_id,
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
