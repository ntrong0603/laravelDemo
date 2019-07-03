<?php

/**
 * Middleware AdminLoginMiddleware
 *
 * @package    App\Http\Middleware
 * @subpackage AdminLoginMiddleware
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->quyen === 1) {
                return $next($request);
            } else {
                return redirect('admin/dangnhap');
            }
        } else {
            return redirect('admin/dangnhap');
        }
    }
}
