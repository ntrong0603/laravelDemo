<div class="col-md-3 ">


    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
            Menu
        </li>

        @foreach ($theloais as $theloai)
        <li href="{{ $theloai->TenKhongDau  }}" class="list-group-item menu1">
            {{ $theloai->Ten }}
        </li>
        @if (count($theloai->loaiTin) > 0)
        <ul>
            @foreach ($theloai->loaiTin as $loaitin)
            <li class="list-group-item">
                <a href="{{ $loaitin->TenKhongDau  }}">{{ $loaitin->Ten }}</a>
            </li>
            @endforeach

        </ul>
        @endif
        @endforeach


    </ul>
</div>
