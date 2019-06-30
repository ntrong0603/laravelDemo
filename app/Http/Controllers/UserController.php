<?php
/**
 * Controllers UserController
 *
 * @package    App\Http\Controllers
 * @subpackage UserController
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class UserController extends Controller
{
    /**
     * Show the list the category
     *
     * @return View
     */
    public function getDanhSach()
    {
        $items = User::all();
        return view('admin.user.danhsach', ['items' => $items]);
    }

    /**
     * Show the form add the category
     *
     * @return View
     */
    public function getThem()
    {
        return view('admin.user.them');
    }

    /**
     * Save the form the user
     *
     * @param  Request  $request
     * @return redirect admin/user/them
     */
    public function postThem(Request $request)
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
        $user->quyen    = $request->quyen;
        $user->save();

        return redirect('admin/user/them')->with('thongbao', 'Thêm thành công');
    }

    /**
     * Show the form edit the category
     *
     * @return View
     */
    public function getSua()
    {
        return view('admin.user.sua');
    }
}
