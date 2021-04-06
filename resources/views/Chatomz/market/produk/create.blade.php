@section('title')
    Market - Tambah Produk
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
                <li class="breadcrumb-item active">Tambah Produk</li>
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
                @if (Auth::user()->level == 'admin')
                    <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Produk Baru </a>
                @endif
                {{-- <a href="#" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-print"></i> Hapus Data Terpilih</a> --}}
                {{-- <a href="{{ url('/artikel')}}" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-print"></i> Kembali ke artikel</a> --}}
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <section>
                    <form action="{{ url('/produk')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                @if (Auth::user()->level == 'admin')
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">Toko <span class="text-danger">*</span></label>
                                        <select name="toko_id" id="" class="form-control col-md-8" required>
                                            @foreach ($toko as $item)
                                                <option value="{{ $item->id}}">{{ $item->nama_toko}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                @endif
                                <div class="form-group row">
                                    <label for="" class="col-md-4 p-2">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_produk" class="form-control col-md-8" placeholder="Nama Produk" value="{{ old('nama_produk')}}" required>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 p-2">Stok Produk <span class="text-danger">*</span></label>
                                    <input type="number" name="stok" class="form-control col-md-8" placeholder="Stok Produk" value="{{ old('stok')}}" required>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 p-2">Harga Produk <span class="text-danger">*</span></label>
                                    <input type="text" name="harga_produk" id="rupiah" class="form-control col-md-8" placeholder="Harga Produk" value="{{ old('harga_produk')}}" required>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 p-2">Keterangan <span class="text-danger">*</span></label>
                                    <textarea name="keterangan_produk" class="form-control col-md-8" cols="10" rows="4" required>{{ old('keterangan_produk')}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-4 p-2">Kategori <span class="text-danger">*</span></label>
                                    <select name="kategoriproduk_id" id="" class="form-control col-md-8" required>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id}}">{{ strtoupper($item->nama_kategori)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 p-2">Photo Produk <span class="text-danger">*</span></label>
                                    <input type="file" name="poto_produk" class="form-control col-md-8" required>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 p-2">Photo tambahan 1</label>
                                    <input type="file" name="poto_1" class="form-control col-md-8">
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 p-2">Photo tambahan 2</label>
                                    <input type="file" name="poto_2" class="form-control col-md-8">
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 p-2">Photo tambahan 3</label>
                                    <input type="file" name="poto_3" class="form-control col-md-8">
                                </div>
                                <hr>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> SIMPAN PRODUK</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
