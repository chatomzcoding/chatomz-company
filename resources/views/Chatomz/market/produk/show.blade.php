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
                    @if ($diskon)
                        <a href="#" class="btn btn-outline-success btn-flat btn-sm" data-toggle="modal" data-target="#edit"><i class="fas fa-pen"></i> Edit Diskon</a>
                    @else
                        <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambahkan Diskon</a>
                    @endif
                    <a href="{{ url('/produk')}}" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-print"></i> Kembali ke daftar produk</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                <section>
                        <div class="row">
                            <div class="col-md-12">
                               <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th width="30%">Nama Produk</th>
                                            <td>: {{ $produk->nama_produk}}</td>
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
                                            <th>Stok Produk</th>
                                            <td>: {{ $produk->stok}}</td>
                                        </tr>
                                        <tr>
                                            <th>kategori</th>
                                            <td>: {{ $kategori->nama_kategori}}</td>
                                        </tr>
                                        <tr>
                                            <th>Dilihat</th>
                                            <td>: {{ $produk->dilihat}} kali</td>
                                        </tr>
                                        @if ($diskon)
                                            <tr class="table-success">
                                                <th class="text-danger">DISKON {{ $diskon->nama_diskon}}</th>
                                                <td>
                                                    : Diskon <strong>{{ $diskon->nilai_diskon}}%</strong>  dari tanggal ( {{ date_indo($diskon->tgl_awal).' - '.date_indo($diskon->tgl_akhir)}} ) 
                                                    <form id="data-{{ $diskon->id }}" action="{{ url('/produk-diskon/'.$diskon->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <button onclick="deleteRow( {{ $diskon->id }} )" class="btn btn-danger btn-sm">HAPUS DISKON</button>    
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                               </div>
                            </div>
                            <div class="col-md-3 text-center font-weight-bold">
                                <p>Poto Produk</p>
                                <img src="{{ asset('/img/market/produk/'.$produk->poto_produk)}}" alt="tidak ada" class="img-fluid">
                            </div>
                            <div class="col-md-3 text-center font-weight-bold">
                                <p>Poto Tambahan 1</p>
                                <img src="{{ asset('/img/market/produk/'.$produk->poto_1)}}" alt="tidak ada" class="img-fluid">
                            </div>
                            <div class="col-md-3 text-center font-weight-bold">
                                <p>Poto Tambahan 2</p>
                                <img src="{{ asset('/img/market/produk/'.$produk->poto_2)}}" alt="tidak ada" class="img-fluid">
                            </div>
                            <div class="col-md-3 text-center font-weight-bold">
                                <p>Poto Tambahan 3</p>
                                <img src="{{ asset('/img/market/produk/'.$produk->poto_3)}}" alt="tidak ada" class="img-fluid">
                            </div>
                        </div>
                </section>
              </div>
            </div>
          </div>
        </div>
    </div>

       {{-- modal tambah --}}
       <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/produk-diskon')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id}}">
            <div class="modal-header">
            <h4 class="modal-title">Tambahkan Diskon untuk produk {{ $produk->nama_produk}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Tgl Awal Diskon <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_awal" class="form-control col-md-8" min="{{ tgl_sekarang()}}" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Tgl Akhir Diskon <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_akhir" class="form-control col-md-8" min="{{ tgl_sekarang()}}" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Diskon berapa % (0-100)</label>
                        <input type="number" name="nilai_diskon" id="nilai_diskon" class="form-control col-md-8" min="0" max="100" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama Diskon (opsional)</label>
                        <input type="text" name="nama_diskon" id="nama_diskon" class="form-control col-md-8" placeholder="contoh: diskon hari raya">
                    </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    <!-- /.modal -->
    @if ($diskon)
        {{-- modal edit diskon --}}
        <div class="modal fade" id="edit">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('/produk-diskon/'.$diskon->id)}}" method="post">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Diskon untuk produk {{ $produk->nama_produk}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Tgl Awal Diskon <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_awal" class="form-control col-md-8" min="{{ tgl_sekarang()}}" value="{{ $diskon->tgl_awal}}" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Tgl Akhir Diskon <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_akhir" class="form-control col-md-8" min="{{ tgl_sekarang()}}" value="{{ $diskon->tgl_akhir}}" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Diskon berapa % (0-100)</label>
                        <input type="number" name="nilai_diskon" id="nilai_diskon" class="form-control col-md-8" min="0" max="100" value="{{ $diskon->nilai_diskon}}" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama Diskon (opsional)</label>
                        <input type="text" name="nama_diskon" id="nama_diskon" class="form-control col-md-8" placeholder="contoh: diskon hari raya"  value="{{ $diskon->nama_diskon}}">
                    </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    <!-- /.modal -->
        
    @endif
</x-app-layout>
