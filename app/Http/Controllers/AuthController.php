<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('home');
    }


        
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $role = $request->input('role'); // Lấy vai trò từ form đăng nhập
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($role === 'student' && $user->role !== 'student') {
                Auth::logout();
                return back()->withErrors(['login_role' => 'Invalid role selected for student login']);
            }
    
            if ($role === 'teacher' && $user->role !== 'teacher') {
                Auth::logout();
                return back()->withErrors(['login_role' => 'Invalid role selected for teacher login']);
            }
    
            if ($role === 'admin' && $user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors(['login_role' => 'Invalid role selected for admin login']);
            }
    
            // Chuyển hướng đúng theo vai trò sau khi xác thực thành công
            if ($role === 'student') {
                return redirect()->route('student.main');
            } elseif ($role === 'teacher') {
                return redirect()->route('teacher.main');
            } elseif ($role === 'admin') {
                return redirect()->route('admin.main');
            }
        }
    
        return back()->withErrors(['login_role' => 'Invalid credentials']);
    }
    
    



    public function showRegisterForm()
    {
        return view('home');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'display_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->display_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            
        ]);

        Auth::login($user);

        return redirect()->intended('/');
    }
}
