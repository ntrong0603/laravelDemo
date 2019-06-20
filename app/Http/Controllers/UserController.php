<?php
/**
 * Controllers UserController
 *
 * @package    App\Http\Controllers
 * @subpackage UserController
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the list the category
     *
     * @return View
     */
    public function getDanhSach()
    {
        $theLoai = TheLoai::all();
        return view('admin.user.danhsach');
    }

    /**
     * Show the form add the category
     *
     * @return View
     */
    public function getThem()
    {
        return view('admin.user.them');
    }

    /**
     * Show the form edit the category
     *
     * @return View
     */
    public function getSua()
    {
        return view('admin.user.sua');
    }
}
