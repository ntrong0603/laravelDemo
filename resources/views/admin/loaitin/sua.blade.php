@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại Tin
                    <small>{{ $item->Ten }}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                    {{ $err }} <br>
                    @endforeach
                </div>
                @endif

                @if (session('thongbao'))
                <div class="alert alert-success">
                    {{ session('thongbao') }}
                </div>
                @endif

                <form action="admin/loaitin/sua/{{ $item->id }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="selTheLoai">
                            @foreach ($theLoai as $tl)
                            <option value="{{ $tl->id }}" @if ($item->idTheLoai === $tl->id)
                                selected
                                @endif> {{ $tl->Ten }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên loại tin</label>
                        <input class="form-control" name="txtTen" placeholder="Nhập tên thể loại"
                            value="{{ $item->Ten }}" />
                    </div>
                    <button type="submit" class="btn btn-default">Thêm loại tin</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                </form>

            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
