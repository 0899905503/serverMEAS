<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */

    protected function redirectTo(Request $request): ?string
    {
        // Kiểm tra nếu yêu cầu không phải là JSON
        if (!$request->expectsJson()) {
            // Chuyển hướng đến trang đăng nhập
            return route('login');
        }

        // Nếu là yêu cầu JSON, không chuyển hướng
        return null;
    }
}
