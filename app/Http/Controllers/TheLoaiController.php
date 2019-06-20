<?php
/**
 * Controllers TheLoaiController
 *
 * @package    App\Http\Controllers
 * @subpackage TheLoaiController
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TheLoai;

class TheLoaiController extends Controller
{
    /**
     * Show the list the category
     *
     * @return View
     */
    public function getDanhSach()
    {
        $items = TheLoai::all();
        return view('admin.theloai.danhsach', ['items' => $items]);
    }

    /**
     * Show the form add the category
     *
     * @return View
     */
    public function getThem()
    {
        return view('admin.theloai.them');
    }

    /**
     * Save the form add the category
     *
     * @param  Request  $request
     * @return redirect admin/theloai/them
     */
    public function postThem(Request $request)
    {
        // use validate check value
        $this->validate(
            $request,
            [
                'txtTen' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'txtTen.required' => 'Bạn chưa nhập tên thể loại',
                'txtTen.unique' => 'Tên thể loại đã tồn tại',
                'txtTen.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'txtTen.max' => 'Tên thế loại không quá 100 ký tự'
            ]
        );

        $item = new TheLoai;
        $item->Ten = $request->txtTen;
        $item->TenKhongDau = changeTitle($request->txtTen);

        $item->save();

        return redirect('admin/theloai/them')->with('thongbao', 'Thêm thành công');
    }

    /**
     * Show the form edit the category
     *
     * @param int $id
     * @return View
     */
    public function getSua($id)
    {
        // get object
        $item = TheLoai::find($id);
        return view('admin.theloai.sua', ['item' => $item]);
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
        // get object
        $item = TheLoai::find($id);

        // use validate check value
        // unique:TheLoai,Ten: kiểm tra trùng trong bảng TheLoai, cột Ten
        $this->validate(
            $request,
            [
                'txtTen' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'txtTen.required' => 'Bạn chưa nhập tên thể loại',
                'txtTen.unique' => 'Tên thể loại đã tồn tại',
                'txtTen.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'txtTen.max' => 'Tên thế loại không quá 100 ký tự'
            ]
        );

        $item->Ten = $request->txtTen;
        $item->TenKhongDau = changeTitle($request->txtTen);

        $item->save();

        return redirect('admin/theloai/sua/' . $id)->with('thongbao', 'Sửa thông tin thành công');
    }

    /**
     * Delete the category
     *
     * @param int $id
     * @return redirect admin/theloai/sanhsach
     */
    public function getXoa($id)
    {
        // get object
        $item = TheLoai::find($id);

        // delete object
        $item->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao', 'Xóa thành công');
    }
}
