<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Kiểm tra xem vai trò của người dùng có trong danh sách roles không
        $userRole = Auth::user()->role;
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized'); // Hoặc bạn có thể điều hướng tới một trang lỗi khác
        }

        return $next($request);
    }
}
