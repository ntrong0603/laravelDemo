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
use App\Model\Comment;

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
     * Save the form add the category
     *
     * @param  Request  $request
     * @return redirect admin/TinTuc/them
     */
    public function postThem(Request $request)
    {
        // use validate check value
        $this->validate(
            $request,
            [
                'idTheLoai' => 'required',
                'idLoaiTin' => 'required',
                'TieuDe' => 'required|min:3|unique:TinTuc,TieuDe',
                'TomTat' => 'required',
                'NoiDung' => 'required'
            ],
            [
                'idTheLoai.required' => 'Bạn chưa chọn thể loại',
                'idLoaiTin.required' => 'Bạn chưa chọn loại tin',
                'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.min' => 'Tiêu đề ít nhất 3 ký tự',
                'TieuDe.unique' => 'Tiêu đề đã tồn tại',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung'
            ]
        );
        $tinTuc = new TinTuc;
        $tinTuc->TieuDe = $request->TieuDe;
        $tinTuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tinTuc->idLoaiTin = $request->idLoaiTin;
        $tinTuc->TomTat = $request->TomTat;
        $tinTuc->NoiDung = $request->NoiDung;

        //check upload image
        if ($request->hasFile('Hinh')) {
            // get image save $file
            $file = $request->file('Hinh');

            // get name image
            $nameHinh = $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();
            $arrType = array('JPG', 'jpg', 'jpeg', 'JPEG', 'png', 'PNG');
            if (!in_array($fileType, $arrType)) {
                //
                return redirect('admin/tintuc/them')->with('loi', 'Bạn chỉ được chọn file có đuôi: JPG, jpg, jpeg, JPEG, png, PNG');
            }

            $newNameHinh = str_random(4) . "_" . time() . "_" . $nameHinh;

            // kiểm tra lại nếu tên random còn trùng
            while (file_exists("upload/tintuc/" . $newNameHinh)) {
                $newNameHinh = str_random(4) . "_" . time() . "_" . $nameHinh;
            }
            $file->move("upload/tintuc", $newNameHinh);
            $tinTuc->Hinh = $newNameHinh;
        } else {
            $tinTuc->Hinh = "";
        }

        $tinTuc->NoiBat = $request->NoiBat;

        $tinTuc->save();

        return redirect('admin/tintuc/them')->with('thongbao', 'Thêm thành công');
    }

    /**
     * Show the form edit the category
     *
     * @return View
     */
    public function getSua($id)
    {
        $item = TinTuc::find($id);
        $theLoai = TheLoai::all();
        $loaiTin = LoaiTin::all();
        // co lien ket roi nen khong can khai bao them bien comment
        return view('admin.tintuc.sua', ['item' => $item, 'theLoai' => $theLoai, 'loaiTin' => $loaiTin]);
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
        $tinTuc = TinTuc::find($id);

        // use validate check value
        $this->validate(
            $request,
            [
                'idTheLoai' => 'required',
                'idLoaiTin' => 'required',
                'TieuDe' => 'required|min:3|unique:TinTuc,TieuDe',
                'TomTat' => 'required',
                'NoiDung' => 'required'
            ],
            [
                'idTheLoai.required' => 'Bạn chưa chọn thể loại',
                'idLoaiTin.required' => 'Bạn chưa chọn loại tin',
                'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.min' => 'Tiêu đề ít nhất 3 ký tự',
                'TieuDe.unique' => 'Tiêu đề đã tồn tại',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung'
            ]
        );

        $tinTuc->TieuDe = $request->TieuDe;
        $tinTuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tinTuc->idLoaiTin = $request->idLoaiTin;
        $tinTuc->TomTat = $request->TomTat;
        $tinTuc->NoiDung = $request->NoiDung;

        //check upload image
        if ($request->hasFile('Hinh')) {
            // get image save $file
            $file = $request->file('Hinh');

            // get name image
            $nameHinh = $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();
            $arrType = array('JPG', 'jpg', 'jpeg', 'JPEG', 'png', 'PNG');
            if (!in_array($fileType, $arrType)) {
                //
                return redirect('admin/tintuc/sua' . $id)->with('loi', 'Bạn chỉ được chọn file có đuôi: JPG, jpg, jpeg, JPEG, png, PNG');
            }

            $newNameHinh = str_random(4) . "_" . time() . "_" . $nameHinh;

            // kiểm tra lại nếu tên random còn trùng
            while (file_exists("upload/tintuc/" . $newNameHinh)) {
                $newNameHinh = str_random(4) . "_" . time() . "_" . $nameHinh;
            }

            $file->move("upload/tintuc", $newNameHinh);
            unlink("upload/tintuc/" . $tinTuc->Hinh);
            $tinTuc->Hinh = $newNameHinh;
        }

        $tinTuc->NoiBat = $request->NoiBat;

        $tinTuc->save();

        return redirect('admin/tintuc/sua/' . $id)->with('thongbao', 'Sửa thông tin thành công');
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
        $item = TinTuc::find($id);

        // delete object
        $item->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xóa thành công');
    }
}
