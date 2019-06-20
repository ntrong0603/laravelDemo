<?php
/**
 * Model LoaiTin
 *
 * @package    App\Model
 * @subpackage LoaiTin
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    protected $table = "loaitin";

    /**
     * Process lien ket den model TheLoai
     * @return object
     */
    public function theLoai()
    {
        return $this->belongsTo('App\Model\TheLoai', 'idTheLoai', 'id');
    }
    /**
     * Process lien ket den model TinTuc
     * @return array
     */
    public function tinTuc()
    {
        return $this->hasMany('App\Model\TinTuc', 'idLoaiTin', 'id');
    }
}
