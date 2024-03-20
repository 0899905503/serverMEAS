<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SalaryScale;

class SalaryDetailsController extends Controller
{

    public function getSalaryDetails($userId)
    {
        // Tìm nhân viên theo ID
        $user = User::find($userId);
        ////////////////////////

        ////////////////////////////////
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Kiểm tra xem người dùng có phòng ban được liên kết hay không
        if (!$user->department) {
            return response()->json(['message' => 'Department not found for this user'], 404);
        }

        $departmentName = $user->department->department;

        if (!$user) {
            return response()->json(['error' => 'Không tìm thấy nhân viên'], 404);
        }

        // Lấy thông tin hệ số lương và bậc lương của nhân viên
        $salaryScale = SalaryScale::where('manv', $userId)->first();

        if (!$salaryScale) {
            return response()->json(['error' => 'Không tìm thấy thông tin hệ số lương và bậc lương cho nhân viên'], 404);
        }

        // Lấy thông tin ngạch của hệ số lương
        $rank = $salaryScale->rank;

        // Lấy hệ số lương và bậc lương
        $mangach = $salaryScale->mangach;
        $bacluong = $salaryScale->bacluong;
        $hesoluong = $salaryScale->hesoluong;
        $luongtheobac = $salaryScale->luongtheobac;
        $tongluong = $luongtheobac * $hesoluong;

        return response()->json([
            'userId' => $userId,
            'department_name' => $departmentName,
            'mangach' => $mangach,
            'bacluong' => $bacluong,
            'hesoluong' => $hesoluong,
            'tenngach' => $rank->tenngach,
            'luongtheobac' => $luongtheobac,
            'tongluong' => $tongluong
        ], 200);
    }
}
