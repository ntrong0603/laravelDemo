<?php
/**
 * Model TinTuc
 *
 * @package    App
 * @subpackage TinTuc
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    protected $table = "tintuc";

    /**
     * Process lien ket den model LoaiTin
     * @return object
     */
    public function loaiTin()
    {
        return $this->belongsTo('App\LoaiTin', 'idLoaiTin', 'id');
    }

     /**
     * Process lien ket den model Comment
     * @return array
     */
    public function comment()
    {
        return $this->hasMany('App\Comment', 'idTinTuc', 'id');
    }
}
