<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\UserController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/users', [UserController::class, 'index']);

//_____________________EMPLOYEE__________________________
Route::get('/employees', [EmployeeController::class, 'show'])->middleware('auth:sanctum');

//_____________________LOGIN AND REGISTER__________________________
Route::post('/auth/signup', [AuthController::class, 'signup']);
Route::post('/auth/signin', [AuthController::class, 'signin']);
// Route::prefix('/auth')->controller(AuthController::class)->group(function () {
//     Route::post('/login', 'login');
//     Route::middleware('auth:sanctum')->group(function () {
//         Route::post('/logout', 'logout');
//         Route::post('/change-password', 'changePassword');
//     });
// });
