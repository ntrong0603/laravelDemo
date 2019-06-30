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
        return view('admin.slide.them');
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
                'Ten' => 'required|min:3|unique:Slide,Ten',
                'Link' => 'required',
                'NoiDung' => 'required',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên',
                'Ten.min' => 'Tên ít nhất 3 ký tự',
                'Ten.unique' => 'Tên đề đã tồn tại',
                'Link.required' => 'Bạn chưa nhập link',
                'NoiDung.required' => 'Bạn chưa nhập nội dung'
            ]
        );
        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->link = $request->Link;
        $slide->NoiDung = $request->NoiDung;

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
                return redirect('admin/slide/them')->with('loi', 'Bạn chỉ được chọn file có đuôi: JPG, jpg, jpeg, JPEG, png, PNG');
            }

            $newNameHinh = str_random(4) . "_" . time() . "_" . $nameHinh;

            // kiểm tra lại nếu tên random còn trùng
            while (file_exists("upload/slide/" . $newNameHinh)) {
                $newNameHinh = str_random(4) . "_" . time() . "_" . $nameHinh;
            }
            $file->move("upload/slide", $newNameHinh);
            $slide->Hinh = $newNameHinh;
        } else {
            $slide->Hinh = "";
        }
        $slide->save();

        return redirect('admin/slide/them')->with('thongbao', 'Thêm thành công');
    }

    /**
     * Show the form edit the category
     *
     * @return View
     */
    public function getSua($id)
    {
        $item = Slide::find($id);
        // co lien ket roi nen khong can khai bao them bien comment
        return view('admin.slide.sua', ['item' => $item]);
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
        // use validate check value
        $this->validate(
            $request,
            [
                'Ten' => 'required|min:3',
                'Link' => 'required',
                'NoiDung' => 'required',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên',
                'Ten.min' => 'Tên ít nhất 3 ký tự',
                'Ten.unique' => 'Tên đề đã tồn tại',
                'Link.required' => 'Bạn chưa nhập link',
                'NoiDung.required' => 'Bạn chưa nhập nội dung'
            ]
        );
        $slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->link = $request->Link;
        $slide->NoiDung = $request->NoiDung;

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
                return redirect('admin/slide/them')->with('loi', 'Bạn chỉ được chọn file có đuôi: JPG, jpg, jpeg, JPEG, png, PNG');
            }

            $newNameHinh = str_random(4) . "_" . time() . "_" . $nameHinh;

            // kiểm tra lại nếu tên random còn trùng
            while (file_exists("upload/slide/" . $newNameHinh)) {
                $newNameHinh = str_random(4) . "_" . time() . "_" . $nameHinh;
            }
            $file->move("upload/slide", $newNameHinh);
            unlink("upload/slide/" . $slide->Hinh);
            $slide->Hinh = $newNameHinh;
        }

        $slide->save();

        return redirect('admin/slide/sua/'.$slide->id)->with('thongbao', 'Sửa thành công');
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
        $item = Slide::find($id);
        unlink("upload/slide/" . $item->Hinh);
        // delete object
        $item->delete();

        return redirect('admin/slide/danhsach')->with('thongbao', 'Xóa thành công');
    }
}
