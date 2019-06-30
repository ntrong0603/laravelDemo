@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
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
                <form action="admin/slide/sua/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tên</label>
                        <input class="form-control" name="Ten" placeholder="Please Enter Name" value="{{ $item->Ten }}"/>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="Link" placeholder="Please Enter Link" value="{{ $item->link }}"/>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea class="ckeditor form-control" rows="3" name="NoiDung">{{ $item->NoiDung }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình</label>
                        <p>
                            <img src="upload/slide/{{ $item->Hinh }}" alt="{{ $item->Ten }}" width="400px">
                        </p>
                        <input type="file" name="Hinh" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-default">Sửa Slide</button>
                    <button type="reset" class="btn btn-default">Làm Mới</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
