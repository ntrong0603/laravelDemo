<?php
/**
 * Model Comment
 *
 * @package    App\Model
 * @subpackage Comment
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    protected $table = "theloai";

    /**
     * Process lien ket den model LoaiTin
     * @return array
     */
    public function loaiTin()
    {
        return $this->hasMany('App\Model\LoaiTin', 'idTheLoai', 'id');
    }

    /**
     * Process lien ket den model TinTuc
     * lien ket thong qua bang(model) LoaiTin
     * @return array
     */
    public function tinTuc()
    {
        return $this->hasManyThrough('App\Model\TinTuc', 'App\Model\LoaiTin', 'idTheLoai', 'idLoaiTin', 'id');
    }
}
