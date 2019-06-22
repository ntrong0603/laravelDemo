<?php
/**
 * Controllers CommentController
 *
 * @package    App\Http\Controllers
 * @subpackage CommentController
 * @copyright  Copyright (c) 2019 Le Ngoc Trong. All Rights Reserved.
 * @author     Le Trong<ntrong0603.dgt@gmail.com>
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Comment;

class CommentController extends Controller
{
    /**
     * Delete the category
     *
     * @param int $id
     * @var mixed $item
     * @return redirect admin/loaitin/sanhsach
     */
    public function getXoa($id, $idTinTuc)
    {
        // get object
        $item = Comment::find($id);

        // delete object
        $item->delete();

        return redirect('admin/tintuc/sua/' . $idTinTuc)->with('thongbao', 'Xóa comment thành công');
    }
}
