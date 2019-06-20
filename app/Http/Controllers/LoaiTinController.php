<?php
/**
 * Controllers LoaiTinController
 *
 * @package    App\Http\Controllers
 * @subpackage LoaiTinController
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    /**
     * Show the list the category
     *
     * @return View
     */
    public function getDanhSach()
    {
        $items = LoaiTin::all();
        return view('admin.loaitin.danhsach', ['items' => $items]);
    }

    /**
     * Show the form add the category
     *
     * @return View
     */
    public function getThem()
    {
        $theLoai = TheLoai::all();
        return view('admin.loaitin.them', ['theLoai' => $theLoai]);
    }

    /**
     * Save the form add the category
     *
     * @param  Request  $request
     * @return redirect admin/loaitin/them
     */
    public function postThem(Request $request)
    {
        // use validate check value
        $this->validate(
            $request,
            [
                'txtTen' => 'required|unique:LoaiTin,Ten|min:3|max:100',
                'selTheLoai' => 'required'
            ],
            [
                'txtTen.required' => 'Bạn chưa nhập tên thể loại',
                'txtTen.unique' => 'Tên đã tồn tại',
                'txtTen.min' => 'Tên phải có độ dài từ 3 đến 100 ký tự',
                'txtTen.max' => 'Tên không quá 100 ký tự',
                'selTheLoai' => 'Bạn chưa chọn thể loại'
            ]
        );

        $item = new LoaiTin;
        $item->Ten = $request->txtTen;
        $item->TenKhongDau = changeTitle($request->txtTen);
        $item->idTheLoai = $request->selTheLoai;

        $item->save();

        return redirect('admin/loaitin/them')->with('thongbao', 'Thêm thành công');
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
        $item = LoaiTin::find($id);
        $theLoai = TheLoai::all();
        return view('admin.loaitin.sua', ['item' => $item, 'theLoai' => $theLoai]);
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
        $item = LoaiTin::find($id);

        // use validate check value
        // unique:LoaiTin,Ten: kiểm tra trùng trong bảng LoaiTin, cột Ten
        $this->validate(
            $request,
            [
                'txtTen' => 'required|unique:LoaiTin,Ten|min:3|max:100',
                'selTheLoai' => 'required'
            ],
            [
                'txtTen.required' => 'Bạn chưa nhập tên thể loại',
                'txtTen.unique' => 'Tên đã tồn tại',
                'txtTen.min' => 'Tên phải có độ dài từ 3 đến 100 ký tự',
                'txtTen.max' => 'Tên không quá 100 ký tự',
                'selTheLoai' => 'Bạn chưa chọn thể loại'
            ]
        );

        $item->Ten = $request->txtTen;
        $item->TenKhongDau = changeTitle($request->txtTen);
        $item->idTheLoai = $request->selTheLoai;

        $item->save();

        return redirect('admin/loaitin/sua/' . $id)->with('thongbao', 'Sửa thông tin thành công');
    }

    /**
     * Delete the category
     *
     * @param int $id
     * @return redirect admin/loaitin/sanhsach
     */
    public function getXoa($id)
    {
        // get object
        $item = LoaiTin::find($id);

        // delete object
        $item->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Xóa thành công');
    }
}
