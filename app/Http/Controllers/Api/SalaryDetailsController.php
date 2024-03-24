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
        $name = "$user->first_name $user->last_name";


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

        // Bổ sung trường tháng tạo bảng lương
        $month = $salaryScale->month;

        return response()->json([
            'userId' => $userId,
            'name' => $name,
            'department_name' => $departmentName,
            'mangach' => $mangach,
            'bacluong' => $bacluong,
            'hesoluong' => $hesoluong,
            'tenngach' => $rank->tenngach,
            'luongtheobac' => $luongtheobac,
            'tongluong' => $tongluong,
            'thang' => $month // Thêm trường tháng tạo bảng lương

        ], 200);
    }
    public function countUserIds()
    {
        $userCount = User::count();

        return response()->json([
            'userCount' => $userCount
        ], 200);
    }
    public function getSalaryDetailsList()
    {
        $salaryDetailsList = [];

        $users = User::all();

        foreach ($users as $user) {
            $userId = $user->id;
            $salaryDetails = $this->getSalaryDetails($userId);

            $salaryDetailsList[] = $salaryDetails->original; // Lấy dữ liệu từ response

            // Hoặc nếu bạn muốn lấy dữ liệu từ API mà không phải response, bạn có thể sử dụng phương thức getSalaryDetails() như sau:
            // $salaryDetailsList[] = $this->getSalaryDetails($userId)->original;
        }

        return response()->json($salaryDetailsList, 200);
    }
}
