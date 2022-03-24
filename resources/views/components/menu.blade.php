<div class="sidebar-menu">
    <ul class="menu">
        <form action="{{ url('cariorang') }}" method="post">
            @csrf
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" name="nama" type="search" placeholder="Cari Nama Orang" aria-label="Search">
              </div>
        </form>
        <hr>
        <li class="sidebar-title mt-0">Menu</li>
        <li class="sidebar-item active ">
            <a href="{{ url('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
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
                    <a href="table-datatable.html" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Datatable</span>
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