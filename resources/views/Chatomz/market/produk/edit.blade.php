@section('title')
    Market - Edit Produk
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
                <li class="breadcrumb-item active">Edit Produk</li>
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
                <a href="{{ url('/produk/'.Crypt::encryptString($produk->id))}}" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-angle-left"></i> Kembali</a>
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
                    <form action="{{ url('/produk/'.$produk->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <ul>
                                        <li>
                                            Tanda <span class="text-danger">*</span> tidak boleh kosong
                                        </li>
                                        <li>
                                            Ukuran Gambar Maksimal <strong>4 Mb</strong> <i>(direkomendasikan dibawah 1 Mb)</i>
                                        </li>
                                        <li>
                                            Rasio Gambar Produk terbaik <strong>1:1 (persegi)</strong> tidak potrait / landscape
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group row">
                                    <label for="" class="col-md-4 pt-2">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_produk" class="form-control col-md-8" placeholder="Nama Produk" value="{{ $produk->nama_produk}}" required>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 pt-2">Stok Produk <span class="text-danger">*</span></label>
                                    <input type="number" name="stok" class="form-control col-md-8" placeholder="Stok Produk" min="0" value="{{ $produk->stok}}" required>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 pt-2">Harga Produk (Rp)<span class="text-danger">*</span></label>
                                    <input type="text" name="harga_produk" id="rupiah" class="form-control col-md-8" placeholder="Harga Produk" value="{{ $produk->harga_produk}}" required>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 pt-2">Keterangan <span class="text-danger">*</span></label>
                                    <textarea name="keterangan_produk" class="form-control col-md-8" cols="10" rows="5" required>{{ $produk->keterangan_produk}}</textarea>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-4 pt-2">Kategori <span class="text-danger">*</span></label>
                                    <select name="kategoriproduk_id" id="" class="form-control col-md-8" required>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id}}" @if ($item->id == $produk->kategoriproduk_id)
                                                selected
                                            @endif>{{ strtoupper($item->nama_kategori)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group row border">
                                    <div class="col-md-4 p-2">
                                        <img src="{{ asset('/img/market/produk/'.$produk->poto_produk)}}" alt="tidak ada" class="img-fluid">
                                    </div>
                                    <div class="col-md-8 pt-2">
                                        <label for="">Photo Produk</label>
                                        <input type="file" name="poto_produk" class="form-control">
                                        <span class="text-danger">[ upload untuk merubah poto produk]</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="form-group row border">
                                    <div class="col-md-4 p-2">
                                        @if (is_null($produk->poto_1))
                                            <img src="{{ asset('/img/market/photo.png')}}" alt="" class="img-fluid">
                                        @else
                                            <img src="{{ asset('/img/market/produk/'.$produk->poto_1)}}" alt="tidak ada" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="col-md-8 pt-2">
                                        <label for="">Photo tambahan 1 @if (is_null($produk->poto_1))
                                            <span class="text-danger">(belum upload)</span>
                                        @endif</label>
                                        <input type="file" name="poto_1" class="form-control">
                                        @if (is_null($produk->poto_1))
                                            <span class="text-primary">[ tambahkan poto 1 ]</span>
                                        @else
                                            <span class="text-danger">[ upload untuk merubah poto 1 ]</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row border">
                                    <div class="col-md-4">
                                        @if (is_null($produk->poto_2))
                                            <img src="{{ asset('/img/market/photo.png')}}" alt="" class="img-fluid">
                                        @else
                                            <img src="{{ asset('/img/market/produk/'.$produk->poto_2)}}" alt="tidak upload" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="col-md-8 pt-2">
                                        <label for="">Photo tambahan 2  @if (is_null($produk->poto_2))
                                            <span class="text-danger">(belum upload)</span>
                                        @endif</label>
                                        <input type="file" name="poto_2" class="form-control">
                                         @if (is_null($produk->poto_2))
                                            <span class="text-primary">[ tambahkan poto 2 ]</span>
                                        @else
                                            <span class="text-danger">[ upload untuk merubah poto 2]</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row border">
                                    <div class="col-md-4">
                                        @if (is_null($produk->poto_3))
                                            <img src="{{ asset('/img/market/photo.png')}}" alt="" class="img-fluid">
                                        @else
                                            <img src="{{ asset('/img/market/produk/'.$produk->poto_3)}}" alt="tidak upload" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="col-md-8 pt-2">
                                        <label for="">Photo tambahan 3 @if (is_null($produk->poto_3))
                                            <span class="text-danger">(belum upload)</span>
                                        @endif</label>
                                        <input type="file" name="poto_3" class="form-control">
                                         @if (is_null($produk->poto_3))
                                            <span class="text-primary">[ tambahkan poto 3 ]</span>
                                        @else
                                            <span class="text-danger">[ upload untuk merubah poto 3 ]</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <hr>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
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
