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
use App\Model\TinTuc;
use App\Model\TheLoai;
use App\Model\LoaiTin;

class TinTucController extends Controller
{
    /**
     * Show the list the product
     *
     * @return View
     */
    public function getDanhSach()
    {
        $items = TinTuc::orderby('id', 'DESC')->get();
        return view('admin.tintuc.danhsach', ['items' => $items]);
    }

    /**
     * Show the form add the category
     *
     * @return View
     */
    public function getThem()
    {
        $theLoai = TheLoai::all();
        $loaiTin = LoaiTin::all();
        return view('admin.tintuc.them', ['theLoai' => $theLoai, 'loaiTin' => $loaiTin]);
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
