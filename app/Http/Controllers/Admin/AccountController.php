<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{

    public function index(Request $request)
    {
        $query = User::orderBy('created_at', 'desc'); // Sắp xếp theo thời gian mới đến cũ
    
        $search = $request->input('search');
        $role = $request->input('role');
    
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
            });
        }
    
        if ($role) {
            $query->where('role', $role);
        }
    
        $users = $query->paginate(5);
    
        return view('admin.accounts.index', compact('users', 'search', 'role'));
    }
    


    public function create()
    {
        return view('admin.accounts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $data['password'] = bcrypt($data['password']);


        User::create($data);

        return redirect()->route('admin.accounts.index')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.accounts.edit', compact('user'));
    }

        public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8', // Password không bắt buộc nhập
            'role' => 'required|string|in:student,teacher,admin',
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
        ]);

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']); // Cập nhật password nếu có
            $user->save();
        }

        return redirect()->route('admin.accounts.index')->with('success', 'Account updated successfully.');
    }


    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.accounts.index')->with('success', 'User deleted successfully');
    }
}
