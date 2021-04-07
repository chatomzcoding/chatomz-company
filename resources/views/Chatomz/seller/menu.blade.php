@php
    $toko = App\Models\Toko::where('user_id',Auth::user()->id)->first();
@endphp
<li class="nav-item">
    <a href="{{ url('/toko/'.Crypt::encryptString($toko->id))}}" class="nav-link">
      <i class="nav-icon fas fa-store"></i>
      <p class="text">Data Toko</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('/produk')}}" class="nav-link">
      <i class="nav-icon fas fa-cube"></i>
      <p class="text">Data Produk</p>
    </a>
</li>