<div class="col-md-3 ">


    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
            Menu
        </li>

        @foreach ($theLoais as $theLoai)
        @if (count($theLoai->loaiTin) > 0)
        <li href="{{ $theLoai->TenKhongDau  }}" class="list-group-item menu1">
            {{ $theLoai->Ten }}
        </li>

        <ul>
            @foreach ($theLoai->loaiTin as $loaiTin)
            <li class="list-group-item">
                <a href="loaitin/{{ $loaiTin->id }}/{{ $loaiTin->TenKhongDau }}.html">{{ $loaiTin->Ten }}</a>
            </li>
            @endforeach

        </ul>
        @endif
        @endforeach


    </ul>
</div>
