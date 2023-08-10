<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\CourseController;

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
Route::get('logout', [AuthController::class, 'logout'])->name('logout');



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


//các route cho quản lý lớp học:
Route::prefix('admin/classrooms')->group(function () {
    Route::get('/', [ClassroomController::class, 'index'])->name('admin.classrooms.index');
    Route::get('/create', [ClassroomController::class, 'create'])->name('admin.classrooms.create');
    Route::post('/', [ClassroomController::class, 'store'])->name('admin.classrooms.store');
    Route::get('/{classroom}', [ClassroomController::class, 'show'])->name('admin.classrooms.show');
    Route::get('/{classroom}/edit', [ClassroomController::class, 'edit'])->name('admin.classrooms.edit');
    Route::put('/{classroom}', [ClassroomController::class, 'update'])->name('admin.classrooms.update');
    Route::delete('/{classroom}', [ClassroomController::class, 'destroy'])->name('admin.classrooms.destroy');

    Route::get('/{classroom}/students', [ClassroomController::class, 'show'])->name('admin.classrooms.students');
    Route::get('/{classroom}/add-student', [ClassroomController::class, 'addStudent'])->name('admin.classrooms.add-student');
    Route::post('/{classroom}/store-student', [ClassroomController::class, 'storeStudent'])->name('admin.classrooms.store-student');
    Route::get('/{classroom}/mark-attendance', [ClassroomController::class, 'markAttendance'])->name('admin.classrooms.mark-attendance');
    Route::post('/{classroom}/store-attendance', [ClassroomController::class, 'storeAttendance'])->name('admin.classrooms.store-attendance');
    Route::delete('admin/classrooms/{classroom}/remove-student/{student}', [ClassroomController::class, 'removeStudent'])->name('admin.classrooms.remove-student');

});


Route::prefix('admin/courses')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/create', [CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/{course}', [CourseController::class, 'show'])->name('admin.courses.show');
    Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/{course}', [CourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/{course}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
    Route::get('/{course}/students', [CourseController::class, 'showStudents'])->name('admin.courses.students');

    // Add new route for adding student to a course
    Route::get('/{course}/add-student', [CourseController::class, 'showAddStudentForm'])->name('admin.courses.showAddStudentForm');
    Route::post('/{course}/add-student', [CourseController::class, 'addStudentToCourse'])->name('admin.courses.addStudentToCourse');

    // Route cho thời khoá biểu
    Route::get('{course}/schedule/create', [CourseController::class, 'createSchedule'])->name('admin.courses.createSchedule');
    Route::post('{course}/schedule', [CourseController::class, 'storeSchedule'])->name('admin.courses.storeSchedule');
    Route::get('{course}/schedule/{schedule}/edit', [CourseController::class, 'editSchedule'])->name('admin.courses.editSchedule');
    Route::put('{course}/schedule/{schedule}', [CourseController::class, 'updateSchedule'])->name('admin.courses.updateSchedule');
    Route::delete('{course}/schedule/{schedule}', [CourseController::class, 'destroySchedule'])->name('admin.courses.destroySchedule');
    
//zzz
    Route::get('{course}/schedule/{schedule}', [CourseController::class, 'showSchedule'])->name('admin.courses.showSchedule');



    // ... other routes ...
});








