<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SalaryScale; // Import model SalaryScale
use App\Models\User;
use App\Models\EmployeeBonus;
use App\Models\EmployeeDiscipline;
use Carbon\Carbon;

class SalaryController extends Controller
{
    public function showSalary()
    {
        $salaryScales = SalaryScale::all();

        return response()->json($salaryScales);
    }

    /**
     * Lấy thông tin của một bản ghi từ bảng salaryscales dựa trên ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showSalaryUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Không tìm thấy thông tin người dùng'], 404);
        }

        $salaryScale = SalaryScale::where('manv', $id)->first();

        if (!$salaryScale) {
            return response()->json(['error' => 'Không tìm thấy thông tin lương nhân viên'], 404);
        }

        return response()->json($salaryScale);
    }

    public function createSalaryScale(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'manv' => 'required|exists:users,id',
            'mangach' => 'required',
            'bacluong' => 'required',
            'hesoluong' => 'required',
            'luongtheobac' => 'required',
            'thang' => ['required', 'date']
        ]);

        // Kiểm tra xem đã tồn tại bản ghi lương cho nhân viên này trong tháng đã cho chưa
        $existingSalaryScale = SalaryScale::where('manv', $validatedData['manv'])
            ->whereYear('thang', Carbon::parse($validatedData['thang'])->year)
            ->whereMonth('thang', Carbon::parse($validatedData['thang'])->month)
            ->exists();

        if ($existingSalaryScale) {
            // Nếu đã tồn tại, trả về thông báo lỗi
            return response()->json(['error' => 'Nhân viên này đã nhận lương trong tháng này.'], 400);
        }

        // Tính toán giá trị của 'tongluong'
        $tongluong = $validatedData['luongtheobac'] * $validatedData['hesoluong'];

        // Tạo một bản ghi mới trong bảng SalaryScale
        $salaryScale = new SalaryScale();
        $salaryScale->manv = $validatedData['manv'];
        $salaryScale->mangach = $validatedData['mangach'];
        $salaryScale->bacluong = $validatedData['bacluong'];
        $salaryScale->hesoluong = $validatedData['hesoluong'];
        $salaryScale->luongtheobac = $validatedData['luongtheobac'];
        $salaryScale->tongluong = $tongluong; // Gán giá trị của 'tongluong'
        $salaryScale->thang = Carbon::parse($validatedData['thang']);
        $salaryScale->save();

        // Trả về thông tin của bản ghi mới đã tạo
        return response()->json($salaryScale, 200);
    }

    public function calculateSalary(Request $request)
    {
        $mangach = $request->input('mangach');
        $bacluong = $request->input('bacluong');
        //   $luongcb = $request->input('luongcb');

        // Tìm hệ số lương dựa trên mangach và bacluong
        $salaryScale = SalaryScale::where('mangach', $mangach)
            ->where('bacluong', $bacluong)
            ->first();

        if (!$salaryScale) {
            return response()->json(['error' => 'Không tìm thấy hệ số lương cho ngạch và bậc lương đã cho'], 404);
        }

        // Lấy hệ số lương từ model
        $hesoluong = $salaryScale->hesoluong;

        // Lấy lương cơ bản từ cột luongcb trong bảng salaryscales
        $luongtheobac = $salaryScale->luongtheobac;

        // Tính toán lương
        $tongLuong =  $luongtheobac * $hesoluong;

        return response()->json(['tong_luong' => $tongLuong], 200);
    }
    public function getSalaryScaleByUserId($userId)
    {
        // Tìm nhân viên theo ID
        $user = User::find($userId);

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

        return response()->json([
            'mangach' => $mangach,
            'bacluong' => $bacluong,
            'hesoluong' => $hesoluong,
            'tenngach' => $rank->tenngach,
            'luongtheobac' => $luongtheobac
        ], 200);
    }

    public function showSalaryByMonth($id, $month, $year)
    {
        // Tìm nhân viên theo ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Không tìm thấy nhân viên'], 404);
        }

        // Lấy thông tin lương của nhân viên theo tháng
        $salaryScale = SalaryScale::where('manv', $id)
            ->whereMonth('thang', $month)
            ->whereYear('thang', $year)

            ->first();

        if (!$salaryScale) {
            return response()->json(['error' => 'NOT FOUND !!!'], 404);
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
            'mangach' => $mangach,
            'bacluong' => $bacluong,
            'hesoluong' => $hesoluong,
            'tenngach' => $rank->tenngach,
            'luongtheobac' => $luongtheobac,
            'tongluong' => $tongluong,
            'thang' => $salaryScale->thang
        ], 200);
    }


    public function showSalariesByMonthAndYear($year, $month)
    {
        // Lấy tất cả các bản ghi lương trong tháng và năm chỉ định
        $salaries = SalaryScale::whereYear('thang', $year)
            ->whereMonth('thang', $month)
            ->get();

        if ($salaries->isEmpty()) {
            return response()->json(['error' => 'Not found'], 404);
        }

        // Tạo một mảng chứa thông tin lương của các nhân viên
        $salariesData = [];

        foreach ($salaries as $salary) {
            if ($salary->employee) {
                $user = $salary->employee;

                // Lấy thông tin phòng ban và chức vụ từ API getDepartmentAndRoleByUserId
                $departmentResponse = $this->getDepartmentAndRoleByUserId($user->id);
                $departmentAndRoleData = json_decode($departmentResponse->content(), true);

                // Kiểm tra xem có lỗi không
                if (isset($departmentAndRoleData['error'])) {
                    // Nếu có lỗi, gán giá trị mặc định
                    $department = 'Chưa có phòng ban';
                    $position = 'Chưa có chức vụ';
                } else {
                    // Nếu không có lỗi, lấy thông tin từ dữ liệu trả về
                    $department = $departmentAndRoleData['department_name'];
                    $position = $departmentAndRoleData['role'];
                }

                // Truy vấn tổng tiền thưởng của nhân viên trong tháng và năm đã cho
                $tienthuong = EmployeeBonus::where('manv', $user->id)
                    ->whereYear('ngaykhenthuong', $year)
                    ->whereMonth('ngaykhenthuong', $month)
                    ->sum('tienthuong');

                // Truy vấn tổng tiền phạt của nhân viên trong tháng và năm đã cho
                $tienphat = Employeediscipline::where('manv', $user->id)
                    ->whereYear('ngaykyluat', $year)
                    ->whereMonth('ngaykyluat', $month)
                    ->sum('tienphat');

                // Tính toán tổng lương
                $tongluong = ($salary->luongtheobac * $salary->hesoluong) + $tienthuong - $tienphat;

                $rank = $salary->rank;
                $salariesData[] = [
                    'manv' => $user->id,
                    'tennv' => $user->first_name,
                    'mangach' => $salary->mangach,
                    'bacluong' => $salary->bacluong,
                    'hesoluong' => $salary->hesoluong,
                    'tenngach' => $rank->tenngach,
                    'luongtheobac' => $salary->luongtheobac,
                    'tienthuong' => $tienthuong,
                    'tienphat' => $tienphat,
                    'tongluong' => $tongluong,
                    'phongban' => $department, // Thêm thông tin phòng ban vào dữ liệu trả về
                    'chucvu' => $position, // Thêm thông tin chức vụ vào dữ liệu trả về
                    'thang' => $salary->thang
                ];
            }
        }
        return response()->json($salariesData, 200);
    }

    public function getDepartmentAndRoleByUserId($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Kiểm tra xem người dùng có phòng ban được liên kết hay không
        $departmentName = $user->department ? $user->department->department : 'Department not found';

        // Lấy chức vụ của người dùng
        $role = $user->role ? $user->role->tenchucvu : 'Role not found';

        return response()->json([
            'userId' => $userId,
            'department_name' => $departmentName,
            'role' => $role
        ], 200);
    }
    public function checkIfSalaryExists(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'manv' => 'required|string',
            'thang' => 'required|date',
        ]);

        $manv = $validatedData['manv'];
        $thang = Carbon::parse($validatedData['thang']);

        $salaryExists = SalaryScale::where('manv', $manv)
            ->whereYear('thang', $thang->year)
            ->whereMonth('thang', $thang->month)
            ->exists();

        return response()->json(['exists' => $salaryExists]);
    }
}
