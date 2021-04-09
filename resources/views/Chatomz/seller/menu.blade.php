@php
    $toko = App\Models\Toko::where('user_id',Auth::user()->id)->first();
@endphp
<li class="nav-item">
    <a href="{{ url('/produk')}}" class="nav-link">
      <i class="nav-icon fas fa-cube"></i>
      <p class="text">Data Produk</p>
    </a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-users-cog"></i>
    <p>
      Pengaturan
      <i class="fas fa-angle-left right"></i>
      {{-- <span class="badge badge-info right">6</span> --}}
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/seller/user')}}" class="nav-link">
        &nbsp;&nbsp;<i class="fas fa-user nav-icon"></i>
        <p>Akun</p>
      </a>
    </li>
  </ul>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/toko/'.Crypt::encryptString($toko->id))}}" class="nav-link">
        &nbsp;&nbsp;<i class="fas fa-store nav-icon"></i>
        <p>Toko</p>
      </a>
    </li>
  </ul>
</li>