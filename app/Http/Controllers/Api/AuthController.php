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
                    'Personal_Id' => 'required',
                    'email' => 'required|string|unique:users',
                    'password' => 'required|string|min:8',
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'phone_number' => 'required',
                    'gender' => 'required',
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
                    'Department_id' => 'required',
                    'Role_id' => 'required',
                    'Qualification' => 'required',
                    'Subsidy_id' => 'required',
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
                'Personal_Id' => $request->Personal_Id,
                'Qualification' => $request->Qualification,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
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
                'Role_id' => $request->Role_id,
                'Subsidy_id' => $request->Subsidy_id,
                'Department_id' => $request->Department_id
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
            // Check Remember Me
            $rememberMe = $request->input('remember_me', false);
            if ($rememberMe) {
                // Save the user's information to shared_preferences
                $this->rememberMe($request->email, $user->api_token);
            }
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
    private function rememberMe($email, $token)
    {
        $rememberData = [
            'email' => $email,
            'token' => $token,
        ];

        $rememberData = json_encode($rememberData);

        // Lưu thông tin vào shared_preferences
        Redis::set('remember_me:' . $email, $rememberData);
    }
    public function updateUserInfo(Request $request, $id)
    {
        try {
            // Xác thực người dùng
            $user = Auth::user();

            // Kiểm tra quyền hạn, ví dụ: chỉ quản trị viên mới có quyền chỉnh sửa nhân viên
            // if (!$user->isAdmin()) {
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'Permission denied. Only admins can update user information.',
            //     ], 403);
            // }

            // Tìm người dùng theo ID
            $userToUpdate = User::find($id);

            // Kiểm tra xem người dùng tồn tại hay không
            if (!$userToUpdate) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found.',
                ], 404);
            }

            // Cập nhật thông tin của người dùng
            $userToUpdate->update([
                'Personal_Id' => $request->Personal_Id,
                'Qualification' => $request->Qualification,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
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
                'Role_id' => $request->Role_id,
                'Subsidy_id' => $request->Subsidy_id,
                'Department_id' => $request->Department_id
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User information updated successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function deleteUser($id)
    {
        try {
            // Xác thực người dùng
            $user = Auth::user();

            // Kiểm tra quyền hạn, ví dụ: chỉ quản trị viên mới có quyền xóa nhân viên
            // if (!$user->isAdmin()) {
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'Permission denied. Only admins can delete users.',
            //     ], 403);
            // }

            // Tìm người dùng theo ID
            $userToDelete = User::find($id);

            // Kiểm tra xem người dùng tồn tại hay không
            if (!$userToDelete) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found.',
                ], 404);
            }

            // Thực hiện xóa người dùng
            $userToDelete->delete();

            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    public function __invoke()
    {
        // Phương thức xử lý cho API logout
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Lấy thông tin Remember Me từ shared_preferences
        $rememberMeData = Redis::get('remember_me:' . Auth::user()->email);

        // Nếu tồn tại thông tin Remember Me, xóa nó
        if ($rememberMeData) {
            Redis::del('remember_me:' . Auth::user()->email);
        }

        return response()->json(['message' => 'Logged out successfully']);
    }
}
