<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

// Đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route cho người dùng đã đăng nhập
Route::middleware(['auth'])->group(function () {
    // Đường dẫn chung cho người dùng đăng nhập
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Đường dẫn cụ thể cho từng vai trò
    Route::middleware('checkrole:student')->group(function () {
        Route::get('/student/main', function () {
            return view('Student/main');
        })->name('student.main');
    });

    Route::middleware('checkrole:teacher')->group(function () {
        Route::get('/teacher/main', function () {
            return view('Teacher/main');
        })->name('teacher.main');
    });

    Route::middleware('checkrole:admin')->group(function () {
        Route::get('/admin/main', function () {
            return view('Admin/main');
        })->name('admin.main');
    });
});
