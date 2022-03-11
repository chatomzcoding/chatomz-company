<li class="nav-item {{ menudropdown(['orang','keluarga','grup','jejak'],$menu) }}">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-user-secret"></i>
      <p>
        Kingdomz
        <i class="fas fa-angle-left right"></i>
        {{-- <span class="badge badge-info right">6</span> --}}
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ url('/orang')}}" class="nav-link {{ menuaktif($menu,'orang') }}">
          &nbsp;&nbsp;<i class="fas fa-user nav-icon"></i>
          <p>Orang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/keluarga')}}" class="nav-link  {{ menuaktif($menu,'keluarga') }}">
          &nbsp;&nbsp;<i class="fas fa-users nav-icon"></i>
          <p>Keluarga</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/grup')}}" class="nav-link  {{ menuaktif($menu,'grup') }}">
          &nbsp;&nbsp;<i class="fas fa-id-card nav-icon"></i>
          <p>Grup</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/jejak')}}" class="nav-link  {{ menuaktif($menu,'jejak') }}">
          &nbsp;&nbsp;<i class="fas fa-id-card nav-icon"></i>
          <p>Jejak</p>
        </a>
      </li>
    </ul>
</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-code"></i>
    <p>
      Coding
      <i class="fas fa-angle-left right"></i>
      {{-- <span class="badge badge-info right">6</span> --}}
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/chatomzbot')}}" class="nav-link">
        &nbsp;&nbsp;<i class="fas fa-robot nav-icon"></i>
        <p>Bot</p>
      </a>
    </li>
  </ul>
</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-business-time"></i>
    <p>
      Bisnis
      <i class="fas fa-angle-left right"></i>
      {{-- <span class="badge badge-info right">6</span> --}}
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/wadec')}}" class="nav-link">
        &nbsp;&nbsp;<i class="fas fa-palette nav-icon"></i>
        <p>WadeC</p>
      </a>
    </li>
  </ul>
</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-laptop-house"></i>
    <p>
      Asset
      <i class="fas fa-angle-left right"></i>
      {{-- <span class="badge badge-info right">6</span> --}}
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/barang')}}" class="nav-link">
        &nbsp;&nbsp;<i class="fas fa-chart-bar nav-icon"></i>
        <p>Barang</p>
      </a>
    </li>
  </ul>
</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-blog"></i>
    <p>
      Informasi
      <i class="fas fa-angle-left right"></i>
      {{-- <span class="badge badge-info right">6</span> --}}
    </p>
  </a>
  <ul class="nav nav-treeview">
        @foreach (DbChatomz::showtable('kategori',['label','informasi']) as $item)
      <li class="nav-item">
        <a href="{{ url('/informasi?k='.Crypt::encrypt($item->id))}}" class="nav-link">
          &nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
          <p>{{ $item->nama_kategori }}</p>
        </a>
      </li>
    @endforeach
  </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-user-tie"></i>
      <p>
        Admin
        <i class="fas fa-angle-left right"></i>
        {{-- <span class="badge badge-info right">6</span> --}}
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ url('/info-website')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-bullhorn nav-icon"></i>
          <p>Info Website</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/adminuser')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-user nav-icon"></i>
          <p>User</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/kategori')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-list nav-icon"></i>
          <p>Kategori</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/merk')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-border-none nav-icon"></i>
          <p>Merk</p>
        </a>
      </li>
    </ul>
</li>
{{-- <li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-laptop-house"></i>
    <p>
      Sistem
      <i class="fas fa-angle-left right"></i>
      <span class="badge badge-info right">6</span>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/visitor')}}" class="nav-link">
        &nbsp;&nbsp;<i class="fas fa-chart-bar"></i>
        <p>Visitor</p>
      </a>
    </li>
  </ul>
</li> --}}
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-code"></i>
    <p>
      Demo
      <i class="fas fa-angle-left right"></i>
      {{-- <span class="badge badge-info right">6</span> --}}
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/demo/grab')}}" class="nav-link">
        &nbsp;&nbsp;<i class="fas fa-robot nav-icon"></i>
        <p>Grab</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('/demo/mazer')}}" class="nav-link">
        &nbsp;&nbsp;<i class="fas fa-robot nav-icon"></i>
        <p>Mazer</p>
      </a>
    </li>
  </ul>
</li>