<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RelativeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Models\Employee;
use App\Models\Relative;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\SalaryDetailsController;
use App\Http\Controllers\SalaryStatisticController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', [UserController::class, 'getUserInfo'])->middleware('auth:sanctum');
Route::get('/getAllUsers', [UserController::class, 'getAllUser']);
Route::get('/getUserById/{id}', [UserController::class, 'getUserById']);
//_____________________EMPLOYEE__________________________
//oute::get('/employee/{employeeId}', [EmployeeController::class, 'getEmployeeInfo'])->middleware('auth:sanctum');


// ROLEs

Route::get('/getRoleById/{id}', [RoleController::class, 'getRoleById']);

//_____________________LOGIN AND REGISTER__________________________
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::get('/auth/delete/{id}', [AuthController::class, 'deleteUser']);
Route::put('/auth/updateUser/{id}', [AuthController::class, 'updateUserInfo']);
// Get Ralatives

Route::get('/getRelativesAndRelationships/{id}', [RelativeController::class, 'getRelativesAndRelationships']);
Route::get('/getRelative', [RelativeController::class, 'getRelative']);
Route::get('/getRelationship', [RelativeController::class, 'getRelationship']);


Route::post('/storeImage', [ImageController::class, 'storeImage'])->middleware('auth:sanctum');
Route::post('/logout', AuthController::class, 'logout')->middleware('auth:sanctum');

//Create Relative
Route::post('/createRelative', [RelativeController::class, 'createRelative']);
//Delete Relative
Route::get('/deleteRelative/{id}', [RelativeController::class, 'deleteRelative']);

//department
Route::get('/getDepartmentName/{id}', [AuthController::class, 'getDepartmentName']);

//Salary
Route::post('/calculateSalary', [SalaryController::class, 'calculateSalary']);
Route::post('/getSalaryScaleByUserId/{id}', [SalaryController::class, 'getSalaryScaleByUserId']);

//salary Details

Route::post('/getSalaryDetails/{id}', [SalaryDetailsController::class, 'getSalaryDetails']);
Route::get('/showSalary', [SalaryController::class, 'showSalary']);
Route::get('/showSalaryUser/{id}', [SalaryController::class, 'showSalaryUser']);


Route::get('/countUserIds', [SalaryDetailsController::class, 'countUserIds']);
Route::get('/getSalaryDetailsList', [SalaryDetailsController::class, 'getSalaryDetailsList']);
Route::get('/salaryHistory/{id}', [SalaryDetailsController::class, 'salaryHistory']);

/// CREATE SALARY STATISTIC
Route::post('/createSalaryScale', [SalaryController::class, 'createSalaryScale']);
Route::get('/salary/{id}/{month}/{year}', [SalaryController::class, 'showSalaryByMonth']);
Route::get('/showSalariesByMonthAndYear/{year}/{month} ', [SalaryController::class, 'showSalariesByMonthAndYear']);
//Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

// Route::prefix('/auth')->controller(AuthController::class)->group(function () {
//     Route::post('/login', 'login');
//     Route::middleware('auth:sanctum')->group(function () {
//         Route::post('/logout', 'logout');
//         Route::post('/change-password', 'changePassword');
//     });
// });
