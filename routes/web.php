<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('admin/dangnhap', 'UserController@getDangNhapAdmin');
Route::post('admin/dangnhap', 'UserController@postDangNhapAdmin');
Route::get('admin/logout', 'UserController@getDangXuatAdmin');

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
    Route::group(['prefix' => 'theloai'], function () {
        //admin/theloai/danhsach
        Route::get('danhsach', 'TheLoaiController@getDanhSach');

        Route::get('sua/{id}', 'TheLoaiController@getSua');
        Route::post('sua/{id}', 'TheLoaiController@postSua');

        Route::get('them', 'TheLoaiController@getThem');
        Route::post('them', 'TheLoaiController@postThem');

        Route::get('xoa/{id}', 'TheLoaiController@getXoa');
    });

    Route::group(['prefix' => 'loaitin'], function () {
        //admin/loaitin/danhsach
        Route::get('danhsach', 'LoaiTinController@getDanhSach');

        Route::get('sua/{id}', 'LoaiTinController@getSua');
        Route::post('sua/{id}', 'LoaiTinController@postSua');

        Route::get('them', 'LoaiTinController@getThem');
        Route::post('them', 'LoaiTinController@postThem');

        Route::get('xoa/{id}', 'LoaiTinController@getXoa');
    });

    Route::group(['prefix' => 'tintuc'], function () {
        //admin/tintuc/danhsach
        Route::get('danhsach', 'TinTucController@getDanhSach');

        Route::get('sua/{id}', 'TinTucController@getSua');
        Route::post('sua/{id}', 'TinTucController@postSua');

        Route::get('them', 'TinTucController@getThem');
        Route::post('them', 'TinTucController@postThem');

        Route::get('xoa/{id}', 'TinTucController@getXoa');
    });

    Route::group(['prefix' => 'comment'], function () {
        //admin/tintuc/danhsach

        Route::get('xoa/{id}/{idTinTuc}', 'CommentController@getXoa');
    });

    Route::group(['prefix' => 'slide'], function () {
        //admin/tintuc/danhsach
        Route::get('danhsach', 'SlideController@getDanhSach');

        Route::get('sua/{id}', 'SlideController@getSua');
        Route::post('sua/{id}', 'SlideController@postSua');

        Route::get('them', 'SlideController@getThem');
        Route::post('them', 'SlideController@postThem');

        Route::get('xoa/{id}', 'SlideController@getXoa');
    });

    Route::group(['prefix' => 'user'], function () {
        //admin/tintuc/danhsach
        Route::get('danhsach', 'UserController@getDanhSach');

        Route::get('sua/{id}', 'UserController@getSua');
        Route::post('sua/{id}', 'UserController@postSua');

        Route::get('them', 'UserController@getThem');
        Route::post('them', 'UserController@postThem');

        Route::get('xoa/{id}', 'UserController@getXoa');
    });

    Route::group(['prefix' => 'ajax'], function () {
        Route::get('loaitin/{idTheLoai?}', 'AjaxController@getLoaiTin')->name('getLoaiTinId');
    });
});


Route::get('/', 'PageController@trangChu');

Route::get('trangchu', 'PageController@trangChu');
Route::get('lienhe', 'PageController@lienHe');
Route::get('loaitin/{id}/{tenKhongDau}.html', 'PageController@loaiTin');
Route::get('tintuc/{id}/{tieuDeKhongDau}.html', 'PageController@tinTuc');
Route::post('comment/{id}', 'CommentController@postComment');
Route::get('nguoidung', 'PageController@getNguoiDung');
Route::post('nguoidung', 'PageController@postNguoiDung');

Route::get('dangnhap', 'PageController@getDangNhap');
Route::post('dangnhap', 'PageController@postDangNhap');
Route::get('dangxuat', 'PageController@dangXuat');
Route::get('dangky', 'PageController@getDangKy');
Route::post('dangky', 'PageController@postDangKy');

Route::get('timkiem', 'PageController@timKiem');
