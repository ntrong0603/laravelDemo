<?php
/**
 * Controllers SlideController
 *
 * @package    App\Http\Controllers
 * @subpackage SlideController
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Slide;

class SlideController extends Controller
{
    /**
     * Show the list the product
     *
     * @return View
     */
    public function getDanhSach()
    {
        //
        $items = Slide::all();
        return view('admin.slide.danhsach', ['items' => $items]);
    }

    /**
     * Show the form add the category
     *
     * @return View
     */
    public function getThem()
    {
        //
    }

    /**
     * Save the form add the category
     *
     * @param  Request  $request
     * @return redirect admin/TinTuc/them
     */
    public function postThem(Request $request)
    {
        //
    }

    /**
     * Show the form edit the category
     *
     * @return View
     */
    public function getSua($id)
    {
        //
    }

    /**
     * Save the form edit the category
     *
     * @param Request $request
     * @param int $id
     * @return redirect admin/theloai/sua/{$id}
     */
    public function postSua(Request $request, $id)
    {
        //
    }

    /**
     * Delete the category
     *
     * @param int $id
     * @return redirect admin/loaitin/sanhsach
     */
    public function getXoa($id)
    {
        //
    }
}
