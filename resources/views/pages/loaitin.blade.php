@extends('layout.index')
@section('content')
<!-- Page Content -->
<div class="container">
    <div class="row">
        @include('layout.menu')

        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;">
                    <h4><b>{{ $loaiTin->Ten }}</b></h4>
                </div>

                @foreach ($tinTuc as $item)
                <div class="row-item row">
                    <div class="col-md-3">

                        <a href="detail.html">
                            <br>
                            <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{ $item->Hinh }}" alt="{{ $item->TieuDe }}">
                        </a>
                    </div>

                    <div class="col-md-9">
                        <h3>{{ $item->TieuDe }}</h3>
                        <p>{!! $item->TomTat !!}</p>
                        <a class="btn btn-primary" href="tintuc/{{ $item->id }}/{{ $item->TieuDeKhongDau }}.html">View Project <span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                    <div class="break"></div>
                </div>
                @endforeach


                <!-- Pagination -->
                <div class="row text-center">
                    {{ $tinTuc->links() }}
                </div>
                <!-- /.row -->

            </div>
        </div>

    </div>

</div>
<!-- end Page Content -->
@endsection
