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
use App\Model\Slide;
use App\Model\LoaiTin;
use App\Model\TinTuc;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class PageController extends Controller
{
    public function __construct()
    {
        // share var all page
        $theLoais = TheLoai::all();
        $slider = Slide::all();
        view()->share('theLoais', $theLoais);
        view()->share('slider', $slider);

        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                view()->share('nguoiDung', Auth::user());
            }
            return $next($request);
        });
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

    /**
     *
     * @return mixed
     */
    public function loaiTin($id)
    {
        $loaiTin = LoaiTin::find($id);
        $tinTuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
        return view('pages.loaitin', ['loaiTin' => $loaiTin, 'tinTuc' => $tinTuc]);
    }


    /**
     *
     * @return mixed
     */
    public function tinTuc($id)
    {
        $tinTuc = TinTuc::find($id);
        $tinNoiBat = TinTuc::where('NoiBat', 1)->where('id', '!=', $id)->take(4)->get();
        $tinLienQuan = TinTuc::where('idLoaiTin', $tinTuc->idLoaiTin)->where('id', '!=', $id)->take(4)->get();
        return view('pages.tintuc', ['tinTuc' => $tinTuc, 'tinNoiBat' => $tinNoiBat, 'tinLienQuan' => $tinLienQuan]);
    }

    public function getDangNhap()
    {
        return view('pages.dangnhap');
    }

    public function postDangNhap(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required|min:6|max:32'
            ],
            [
                'email.required' => 'Bạn chưa nhập địa chỉ email',
                'password.required' => 'Bạn chưa nhập password',
                'password.min' => 'Password tối thiểu 6 ký tự',
                'password.max' => 'Password tối đa 32 ký tự'
            ]
        );
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('trangchu');
        } else {
            return redirect('dangnhap')->with('loi', 'Đăng nhập không thành công');
        }
    }

    public function dangXuat()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('trangchu');
    }

    public function getNguoiDung()
    {
        if (Auth::check()) {
            return view('pages.nguoidung');
        } else {
            return redirect('trangchu');
        }
    }

    public function postNguoiDung(Request $request)
    {
        // use validate check value
        $this->validate(
            $request,
            [
                'name'          => 'required|min:6',
                'passwordAgain' => 'same:password'
            ],
            [
                'name.required'             => 'Bạn chưa nhập tên',
                'name.min'                  => 'Tên ít nhất 6 ký tự',
                'passwordAgain.same'        => 'Mật khẩu nhập lại không khớp'
            ]
        );
        $user           = Auth::user();
        $user->name     = $request->name;

        if ($request->changePassword == "on") {
            $this->validate(
                $request,
                [

                    'password'      => 'required|min:6|max:32',
                    'passwordAgain' => 'required|same:password'
                ],
                [
                    'password.required'         => 'Bạn chưa nhập password',
                    'password.min'              => 'Mật khẩu ít nhất 6 ký tự',
                    'password.max'              => 'Mật khẩu nhiều nhất 32 ký tự',
                    'passwordAgain.required'    => 'Bạn chưa nhập lại mật khẩu',
                    'passwordAgain.same'        => 'Mật khẩu nhập lại không khớp'
                ]
            );
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('nguoidung')->with('thongbao', 'Sửa thành công');
    }

    /**
     * Show the form add the category
     *
     * @return View
     */
    public function getDangKy()
    {
        return view('pages.dangky');
    }

    /**
     * Save the form the user
     *
     * @param  Request  $request
     * @return redirect admin/user/them
     */
    public function postDangKy(Request $request)
    {
        // use validate check value
        $this->validate(
            $request,
            [
                'name'          => 'required|min:6',
                'email'         => 'required|unique:Users,email',
                'password'      => 'required|min:6|max:32',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'name.required'             => 'Bạn chưa nhập tên',
                'name.min'                  => 'Tên ít nhất 6 ký tự',
                'email.required'            => 'Bạn chưa nhập email',
                'email.unique'              => 'Địa chỉ email đã tồn tại',
                'password.required'         => 'Bạn chưa nhập password',
                'password.min'              => 'Mật khẩu ít nhất 6 ký tự',
                'password.max'              => 'Mật khẩu nhiều nhất 32 ký tự',
                'passwordAgain.required'    => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'        => 'Mật khẩu nhập lại không khớp'
            ]
        );
        $user           = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen    = 0;
        $user->save();

        return redirect('dangnhap')->with('thongbao', 'Đăng ký thành công');
    }

    public function timKiem(Request $request)
    {
        $keySearch = $request->keySearch;
        $items = TinTuc::where('TieuDe', 'like', "%$keySearch%")
                        ->orWhere('TomTat', 'like', "%$keySearch%")
                        ->orWhere('NoiDung', 'like', "%$keySearch%")
                        ->take(30)->paginate(5);
        return view('pages.timkiem', ['tuKhoa' => $keySearch, 'items' =>   $items]);
    }
}
