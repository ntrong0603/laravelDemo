<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->kiemTraDangNhap();
    }

    /**
     * Process check login now
     * share user if login === true
     */
    public function kiemTraDangNhap()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                view()->share('userLogin', Auth::user());
            }
            return $next($request);
        });
    }
}
