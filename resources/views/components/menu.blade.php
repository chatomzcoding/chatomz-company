<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

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


        {{-- <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-hexagon-fill"></i>
                <span>Form Elements</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="form-element-input.html">Input</a>
                </li>
                <li class="submenu-item ">
                    <a href="form-element-input-group.html">Input Group</a>
                </li>
                <li class="submenu-item ">
                    <a href="form-element-select.html">Select</a>
                </li>
                <li class="submenu-item ">
                    <a href="form-element-radio.html">Radio</a>
                </li>
                <li class="submenu-item ">
                    <a href="form-element-checkbox.html">Checkbox</a>
                </li>
                <li class="submenu-item ">
                    <a href="form-element-textarea.html">Textarea</a>
                </li>
            </ul>
        </li> --}}

        {{-- <li class="sidebar-item">
            <a href="table-datatable.html" class='sidebar-link'>
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>Datatable</span>
            </a>
        </li> --}}
        <li class="sidebar-title">Sistem</li>

        <li class="sidebar-item">
            <a href="{{ url('/user/'.Crypt::encryptString(Auth::user()->id).'/edit')}}" class="sidebar-link">
              <i class="fas fa-user-cog"></i><span>Pengaturan Akun</span>
            </a>
        </li>
        <li class="sidebar-item">
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"  class="sidebar-link"
                    onclick="event.preventDefault();
                            this.closest('form').submit();">
            <i class="fas fa-sign-out-alt"></i><span>Keluar</span></a>
        </form>
        </li>

    </ul>
</div>