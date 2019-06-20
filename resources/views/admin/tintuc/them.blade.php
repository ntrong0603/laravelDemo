@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="idTheLoai">Thể Loại</label>
                        <select class="form-control" name="idTheLoai" id="idTheLoai">
                            @foreach ($theLoai as $tl)
                            <option value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idLoaiTin">Loại Tin</label>
                        <select class="form-control" name="idLoaiTin" id="idLoaiTin">
                            @foreach ($loaiTin as $lt)
                            <option value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Please Enter Username" />
                    </div>
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea class="ckeditor form-control" rows="3" name="TomTat"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea class="ckeditor form-control" rows="3" name="NoiDung"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình</label>
                        <input type="file" name="fImages" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1" checked="" type="radio">Có
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" type="radio"> Không
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm Tin Tức</button>
                    <button type="reset" class="btn btn-default">Làm Mới</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
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
