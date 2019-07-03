<?php

/**
 * Controllers PageController
 *
 * @package    App\Http\Controllers
 * @subpackage PageController
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TheLoai;

class PageController extends Controller
{
    public function __construct()
    {
        // share var all page
        $theloais = TheLoai::all();
        view()->share('theloais', $theloais);
    }
    /**
     *
     * @return mixed
     */
    public function trangChu()
    {

        return view('pages.trangchu');
    }

    /**
     *
     * @return mixed
     */
    public function lienHe()
    {
        return view('pages.lienhe');
    }
}
