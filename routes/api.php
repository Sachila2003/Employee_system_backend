<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;

// public router
Route::post('/login', [AuthController::class, 'login']);

//protected Routers
Route::middleware('auth:sanctum')->group(function(){
   Route::post('/register', [AuthController::class, 'register']);
   Route::apiResource('employees', EmployeeController::class);
   Route::apiResource('departments', DepartmentController::class);
});



