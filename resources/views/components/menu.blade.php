<div class="sidebar-menu">
    <ul class="menu">
        @if (Auth::user()->level == 'admin')
            <section class="d-none d-sm-block">
                <form action="{{ url('pencarian') }}" method="get">
                    @csrf
                    <input type="hidden" name="s" value="carinama">
                    <div class="input-group mb-3">
                        <input type="text" name="nama" class="form-control" placeholder="cari disini ..." aria-label="cari disini ..." aria-describedby="button-addon2" autocomplete="off" required>
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="bi-search"></i></button>
                    </div>
                </form>
                <hr>
        @endif
        </section>
        <li class="sidebar-title mt-0">Menu</li>
        <li class="sidebar-item active ">
            <a href="{{ url('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-house-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @foreach ($menu as $item)
            @if ($item['sub'])
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['title'] }}</span>
                    </a>
                    <ul class="submenu ">
                        @foreach ($item['submenu'] as $i)
                            <li class="submenu-item">
                                <a href="{{ url($i['link']) }}">{{ $i['title'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="sidebar-item  ">
                    <a href="{{ url($item['link']) }}" class='sidebar-link'>
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['title'] }}</span>
                    </a>
                </li>
            @endif
        @endforeach


        <li class="sidebar-title my-2">Sistem</li>

        <li class="sidebar-item">
            <a href="{{ url('/user/'.Crypt::encryptString(Auth::user()->id).'/edit')}}" class="sidebar-link">
              <i class="bi bi-gear"></i> <span>Pengaturan Akun</span>
            </a>
        </li>
        <li class="sidebar-item">
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"  class="sidebar-link"
                    onclick="event.preventDefault();
                            this.closest('form').submit();">
            <i class="bi bi-box-arrow-right"></i><span>Keluar</span></a>
        </form>
        </li>

    </ul>
</div>