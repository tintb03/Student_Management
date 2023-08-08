<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AccountController;

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
    Route::get('/student/main', function () {
        return view('Student.main');
    })->name('student.main');

    Route::get('/teacher/main', function () {
        return view('Teacher.main');
    })->name('teacher.main');

    Route::get('/admin/main', function () {
        return view('Admin.main');
    })->name('admin.main');
});



//hiển thị acc
    Route::get('/admin/accounts', [AccountController::class, 'index'])->name('admin.accounts.index');
//thêm sửa xoá acc
Route::get('/admin/accounts/create', [AccountController::class, 'create'])->name('admin.accounts.create');
Route::post('/admin/accounts', [AccountController::class, 'store'])->name('admin.accounts.store');
Route::get('/admin/accounts/{id}/edit', [AccountController::class, 'edit'])->name('admin.accounts.edit');
Route::put('/admin/accounts/{id}', [AccountController::class, 'update'])->name('admin.accounts.update');
Route::delete('/admin/accounts/{id}', [AccountController::class, 'destroy'])->name('admin.accounts.destroy');

