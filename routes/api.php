<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\EnrollmentController;
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

// Routes for core entities (CRUD)
Route::apiResource('courses', CourseController::class);
Route::apiResource('professors', ProfessorController::class);
Route::apiResource('students', StudentController::class);

// Custom routes for course offerings and enrollments
Route::post('offerings', [OfferingController::class, 'store']); // create a course offering
Route::post('enrollments', [EnrollmentController::class, 'store']); // enroll a student in an offering
Route::get('enrollments', [EnrollmentController::class, 'index']); // list enrollments
