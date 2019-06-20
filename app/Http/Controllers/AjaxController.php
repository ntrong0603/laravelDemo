<?php
/**
 * Controllers AjaxController
 *
 * @package    App\Http\Controllers
 * @subpackage AjaxController
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\LoaiTin;

class AjaxController extends Controller
{
    public function getLoaiTin($idTheLoai)
    {
        $loaiTin = LoaiTin::where('idTheLoai', $idTheLoai)->get();
        foreach ($loaiTin as $lt) {
            echo "<option value='" . $lt->id . "'>" . $lt->Ten . "</option>";
        }
    }
}
