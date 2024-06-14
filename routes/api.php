<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MotorsController;
use App\Http\Controllers\StatusController;
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

Route::post('test',  [dashboardController::class, 'test']);
Route::post('position_test',  [dashboardController::class, 'position_test']);
Route::post('velocity_test',  [dashboardController::class, 'velocity_test']);
Route::post('ARM_test',  [dashboardController::class, 'ARM_test']);
Route::post('PID_test',  [dashboardController::class, 'PID_test']);
Route::get('Get_IP',  [dashboardController::class, 'Get_IP']);
Route::post('assignTask',  [dashboardController::class, 'AssignTask']);

Route::get('/check-log', [LogController::class, 'checkLog']);
Route::get('/status', [StatusController::class, 'checkStaus']);
Route::get('/velocities', [MotorsController::class, 'checkVelocities']);



