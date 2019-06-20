<?php
/**
 * Model Comment
 *
 * @package    App
 * @subpackage Comment
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comment";

     /**
     * Process lien ket den model TinTuc
     * @return object
     */
    public function tinTuc()
    {
        return $this->belongsTo('App\TinTuc', 'idTinTuc', 'id');
    }

     /**
     * Process lien ket den model User
     * @return object
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'idUser', 'id');
    }
}
