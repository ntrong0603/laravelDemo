@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>{{ $item->TieuDe }}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/tintuc/sua/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                        {{ $err }} <br>
                        @endforeach
                    </div>
                    @endif

                    @if (session('thongbao'))
                    <div class="alert alert-danger">
                        {{ session('thongbao') }}
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="idTheLoai">Thể Loại</label>
                        <select class="form-control" name="idTheLoai" id="idTheLoai">
                            @foreach ($theLoai as $tl)
                            <option @if ($item->loaiTin->theLoai->id === $tl->id)
                                {{ "selected" }}
                                @endif value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idLoaiTin">Loại Tin</label>
                        <select class="form-control" name="idLoaiTin" id="idLoaiTin">
                            @foreach ($loaiTin as $lt)
                            <option @if ($item->loaiTin->id === $lt->id)
                                {{ "selected" }}
                                @endif value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Please Enter Username"
                            value="{{ $item->TieuDe }}" />
                    </div>
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea class="ckeditor form-control" rows="3" name="TomTat">{{ $item->TomTat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea class="ckeditor form-control" rows="3" name="NoiDung">{{ $item->NoiDung }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình</label>
                        <p><img src="upload/tintuc/{{ $item->Hinh }}" alt="{{ $item->TieuDe }}" width="150px"></p>
                        <input type="file" name="Hinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1" checked="" type="radio" @if ($item->NoiBat === 1)
                            {{ 'checked' }}
                            @endif>Có
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" type="radio" @if ($item->NoiBat === 0)
                            {{ 'checked' }}
                            @endif> Không
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Lưu</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
        <!-- comment -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Comment
                    <small>Danh sách</small>
                </h1>
            </div>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người Dùng</th>
                        <th>Nội Dung</th>
                        <th>Ngày Đăng</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->comment as $cm)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $cm->id }}</td>
                        <td>{{ $cm->user->name }}</td>
                        <td>{{ $cm->NoiDung }}</td>
                        <td>{{ $cm->created_at }}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                                href="admin/comment/xoa/{{ $cm->id }}/{{ $item->id }}"> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
@section('script')
<script>
    $(document).ready( function () {
        $('#idTheLoai').change(function(){
            var idTheLoai = $(this).val();
            $.get("{{ route('getLoaiTinId') }}/" + idTheLoai, function(data) {
                $('#idLoaiTin').html(data);
            });
        });
    });
</script>
@endsection
