<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('home');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return $this->redirectBasedOnRole(auth()->user()->role);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
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
            'role' => 'required|in:student,teacher,admin',
        ]);

        $user = User::create([
            'name' => $request->display_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        return $this->redirectBasedOnRole($request->role);
    }

    private function redirectBasedOnRole($role)
    {
        if ($role === 'student') {
            return redirect()->route('student.main');
        } elseif ($role === 'admin') {
            return redirect()->route('admin.main');
        } elseif ($role === 'teacher') {
            return redirect()->route('teacher.main');
        }

        return redirect()->intended('/');
    }
}
