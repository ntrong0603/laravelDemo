<!-- slider -->
<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($slider as $key => $item)
                <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" class="
                @if ($key == 0)
                {{ 'active' }}
                @endif "></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($slider as $key => $item)
                <div class="item
                @if ($key == 0)
                    {{ 'active' }}
                @endif ">
                    <img class="slide-image" src="upload/slide/{{ $item->Hinh }}" alt="{{ $item->Ten }}" title="{{ $item->Ten }}">
                </div>
                @endforeach
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>
<!-- end slide -->
