<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/', [StudentController::class, 'countstd'])->name('dashboard');

    Route::get('/student/create', function () {
        return view('create-student');
    })->name('students.create');

    Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');

    Route::get('/students', [StudentController::class, 'get_students'])->name('students.get_students');

    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');

    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');

    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::get('/search-students', [StudentController::class, 'search'])->name('students.search');
});
