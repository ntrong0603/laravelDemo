@extends('layout.index')
@section('content')
<!-- Page Content -->
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{ $tinTuc->TieuDe }}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">Start Bootstrap</a>
            </p>

            <!-- Preview Image -->
            <img class="img-responsive" src="upload/tintuc/{{ $tinTuc->Hinh }}" alt="{{ $tinTuc->TieuDe }}">

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $tinTuc->created_at }}</p>
            <hr>

            <!-- Post Content -->
            <p class="lead">{!! $tinTuc->NoiDung !!}</p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form role="form">
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            @foreach ($tinTuc->comment as $item)
            <div class="media">
                <!--<a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>-->
                <div class="media-body">
                    <h4 class="media-heading">{{ $item->user->name }}
                        <small>{{ $item->created_at }}</small>
                    </h4>
                    {!! $item->NoiDung !!}
                </div>
            </div>
            @endforeach



        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                    @foreach ($tinLienQuan as $item)
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="detail.html">
                                <img class="img-responsive" src="upload/tintuc/{{ $item->Hinh }}"
                                    alt="{{ $item->TieuDe }}">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a
                                href="tintuc/{{ $item->id }}/{{ $item->TieuDeKhongDau }}.html"><b>{{ $item->TieuDe }}</b></a>
                        </div>
                        <p>{!! $item->TomTat !!}</p>
                        <div class="break"></div>
                    </div>
                    <!-- end item -->
                    @endforeach



                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">
                    @foreach ($tinNoiBat as $item)
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="detail.html">
                                <img class="img-responsive" src="upload/tintuc/{{ $item->Hinh }}"
                                    alt="{{ $item->TieuDe }}">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a
                                href="tintuc/{{ $item->id }}/{{ $item->TieuDeKhongDau }}.html"><b>{{ $item->TieuDe }}</b></a>
                        </div>
                        <p>{!! $item->TomTat !!}</p>
                        <div class="break"></div>
                    </div>
                    <!-- end item -->
                    @endforeach
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection
