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
            return redirect('dangnhap')->with('thongbao', 'Đăng nhập không thành công');
        }
    }

    public function dangXuat()
    {
        if (Auth::check()) {
            Auth::logout();
            return back();
        }
    }

}
