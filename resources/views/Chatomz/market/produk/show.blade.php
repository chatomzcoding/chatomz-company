@section('title')
    Market - Detail Produk
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Produk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('produk')}}">Daftar Produk</a></li>
                <li class="breadcrumb-item active">Detail Produk</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                {{-- @if (Auth::user()->level == 'admin')
                    <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Produk Baru </a>
                @endif --}}
                <a href="{{ url('/produk/'.Crypt::encryptString($produk->id).'/edit')}}" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-pen"></i> Edit Produk</a>
                <a href="{{ url('/produk')}}" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-print"></i> Kembali ke daftar produk</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                <section>
                        <div class="row">
                            <div class="col-md-6">
                               <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Nama Produk</th>
                                            <td>: {{ $produk->nama_produk}}</td>
                                        </tr>
                                        <tr>
                                            <th>Stok Produk</th>
                                            <td>: {{ $produk->stok}}</td>
                                        </tr>
                                        <tr>
                                            <th>Harga Produk</th>
                                            <td>: {{ rupiah($produk->harga_produk)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan Produk</th>
                                            <td>: {{ $produk->keterangan_produk}}</td>
                                        </tr>
                                        <tr>
                                            <th>Dilihat</th>
                                            <td>: {{ $produk->dilihat}}</td>
                                        </tr>
                                    </table>
                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>kategori</th>
                                            <td>: {{ $produk->kategoriproduk_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>Poto Produk</th>
                                            <td><img src="{{ asset('/img/market/produk/'.$produk->poto_produk)}}" alt="tidak ada" width="200px"></td>
                                        </tr>
                                        <tr>
                                            <th>Poto Tambahan 1</th>
                                            <td><img src="{{ asset('/img/market/produk/'.$produk->poto_1)}}" alt="tidak ada" width="200px"></td>
                                        </tr>
                                        <tr>
                                            <th>Poto Tambahan 2</th>
                                            <td><img src="{{ asset('/img/market/produk/'.$produk->poto_2)}}" alt="tidak ada" width="200px"></td>
                                        </tr>
                                        <tr>
                                            <th>Poto Tambahan 3</th>
                                            <td><img src="{{ asset('/img/market/produk/'.$produk->poto_3)}}" alt="tidak ada" width="200px"></td>
                                        </tr>
                                    </table>
                               </div>
                            </div>
                        </div>
                </section>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
