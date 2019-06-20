<?php
/**
 * Controllers TinTucController
 *
 * @package    App\Http\Controllers
 * @subpackage TinTucController
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinTucController extends Controller
{
    /**
     * Show the list the category
     *
     * @return View
     */
    public function getDanhSach()
    {
        return view('admin.tintuc.danhsach');
    }

    /**
     * Show the form add the category
     *
     * @return View
     */
    public function getThem()
    {
        return view('admin.tintuc.them');
    }

    /**
     * Show the form edit the category
     *
     * @return View
     */
    public function getSua()
    {
        return view('admin.tintuc.sua');
    }
}
