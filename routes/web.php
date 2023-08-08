<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;

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

//các route cho quản lý chuyên ngành:
Route::prefix('admin/majors')->group(function () {
    Route::get('/', [MajorController::class, 'index'])->name('admin.majors.index');
    Route::get('/create', [MajorController::class, 'create'])->name('admin.majors.create');
    Route::post('/', [MajorController::class, 'store'])->name('admin.majors.store');
    Route::get('/{major}/edit', [MajorController::class, 'edit'])->name('admin.majors.edit');
    Route::put('/{major}', [MajorController::class, 'update'])->name('admin.majors.update');
    Route::delete('/{major}', [MajorController::class, 'destroy'])->name('admin.majors.destroy');
});

//các route cho quản lý giáo viên:
Route::prefix('admin/teachers')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');
    Route::get('/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
    Route::post('/', [TeacherController::class, 'store'])->name('admin.teachers.store');
    Route::get('/{teacher}/edit', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
    Route::put('/{teacher}', [TeacherController::class, 'update'])->name('admin.teachers.update');
    Route::delete('/{teacher}', [TeacherController::class, 'destroy'])->name('admin.teachers.destroy');
});

//các route cho quản lý sinh viên:
Route::prefix('admin/students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('admin.students.index');
    Route::get('/create', [StudentController::class, 'create'])->name('admin.students.create');
    Route::post('/', [StudentController::class, 'store'])->name('admin.students.store');
    Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('/{student}', [StudentController::class, 'update'])->name('admin.students.update');
    Route::delete('/{student}', [StudentController::class, 'destroy'])->name('admin.students.destroy');
});


