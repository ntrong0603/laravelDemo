@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Tóm tắt</th>
                        <th>Thể loại</th>
                        <th>Loại tin</th>
                        <th>Lượt xem</th>
                        <th>Nổi bật</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->TieuDe }}
                            <br />
                            <img src="upload/tintuc/{{ $item->Hinh }}" alt="{{ $item->TieuDe }}"
                                title="{{ $item->TieuDe }}" width="100px">
                        </td>
                        <td>{{ $item->TomTat }}</td>
                        <td>{{ $item->loaiTin->theLoai->Ten }}</td>
                        <td>{{ $item->loaiTin->Ten }}</td>
                        <td>{{ $item->SoLuotXem }}</td>
                        <td>
                            @if ($item->NoiBat === 0)
                            {{ 'Không' }}
                            @else
                            {{ 'Có' }}
                            @endif
                        </td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                                href="admin/tintuc/xoa/{{ $item->id }}"> Delete</a>
                        </td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                href="admin/tintuc/sua/{{ $item->id }}">Edit</a></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
