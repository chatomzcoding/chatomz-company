@section('meta')
    <!-- Image to display -->
    <!-- Replace   «example.com/image01.jpg» with your own -->
    <meta property="og:image" content="{{ asset('/img/market/produk/'.$produk->poto_produk)}}">

    <!-- No need to change anything here -->
    <meta property="og:type" content="website" />
    <meta property="og:image:type" content="image/jpeg">

    <!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">

    <!-- Website to visit when clicked in fb or WhatsApp-->
    <meta property="og:url" content="https://bunefit.com/">
@endsection


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
              <form id="data-{{ $produk->id }}" action="{{url('/produk',$produk->id)}}" method="post">
                  @csrf
                  @method('delete')
                  </form>
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                {{-- @if (Auth::user()->level == 'admin')
                    <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Produk Baru </a>
                    @endif --}}
                    <a href="{{ url('/produk')}}" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-angle-left"></i> Kembali</a>
                    <a href="{{ url('/produk/'.Crypt::encryptString($produk->id).'/edit')}}" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-pen"></i> Edit Produk</a>
                    <button onclick="deleteRow( {{ $produk->id }} )" class="btn btn-outline-danger btn-flat btn-sm"><i class="fas fa-trash-alt"></i> hapus produk</button>
                    @if ($diskon)
                        <a href="#" class="btn btn-outline-danger btn-flat btn-sm" data-toggle="modal" data-target="#edit"><i class="fas fa-pen"></i> Edit Diskon</a>
                    @else
                        <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambahkan Diskon</a>
                    @endif
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  @if (session('ds'))
                    <div class="callout callout-success">
                        Produk sudah tampil diberanda aplikasi <strong>bunefit.com</strong> dan sudah siap dipromosikan. Bagikan lewat whatsapp <a href="{{ market_bagikankewhatsapp($produk->slug)}}" class="text-success"><i class="fab fa-whatsapp-square"></i> Klik Disini</a>
                    </div>
                  @endif
                <section>
                        <div class="row">
                            <div class="col-md-4">
                                <section>
                                    <a href="{{ asset('/img/market/produk/'.$produk->poto_produk)}}" target="_blank"><img src="{{ asset('/img/market/produk/'.$produk->poto_produk)}}" alt="tidak ada" class="img-fluid"></a>
                                </section>
                            </div>
                            <div class="col-md-8">
                                <dl class="row">
                                    <dt class="col-md-4">Nama Produk</dt>
                                    <dd class="col-md-8 text-capitalize">: {{ $produk->nama_produk}}</dd>
                                    <dt class="col-md-4">Harga Produk</dt>
                                    <dd class="col-md-8">: {{ rupiah($produk->harga_produk)}}</dd>
                                    @if ($diskon)
                                    <dt class="col-md-4">Harga Diskon</dt>
                                    <dd class="col-md-8">: {{ rupiah(market_hitungdiskon($produk->harga_produk,$diskon->nilai_diskon))}}</dd>
                                    @endif
                                    <dt class="col-md-4">Keterangan Produk</dt>
                                    <dd class="col-md-8">: {{ $produk->keterangan_produk}}</dd>
                                    <dt class="col-md-4">Stok Produk</dt>
                                    <dd class="col-md-8">: {{ $produk->stok}}</dd>
                                    <dt class="col-md-4">kategori</dt>
                                    <dd class="col-md-8">: {{ $kategori->nama_kategori}}</dd>
                                    <dt class="col-md-4">Dilihat</dt>
                                    <dd class="col-md-8">: {{ $produk->dilihat}} kali</dd>
                                    <dt class="col-md-4">Bagikan lewat whastapp</dt>
                                    <dd class="col-md-8">: <a href="{{ market_bagikankewhatsapp($produk->slug)}}" class="text-success"><i class="fab fa-whatsapp-square"></i> Klik Disini</a></dd>
                                    @if ($diskon)
                                    <dt class="col-md-4">DISKON {{ $diskon->nama_diskon}}</dt>
                                    <dd class="col-md-8"> : Diskon <strong>{{ $diskon->nilai_diskon}}%</strong>  dari tanggal ( {{ date_indo($diskon->tgl_awal).' - '.date_indo($diskon->tgl_akhir)}} ) 
                                        <form id="data-{{ $diskon->id }}" action="{{ url('/produk-diskon/'.$diskon->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <button onclick="deleteRow( {{ $diskon->id }} )" class="btn btn-danger btn-sm">HAPUS DISKON</button> </dd>
                                    @endif
                                </dl>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-smile-wink text-success"></i> Tips Chatomz!</h5>
                                    <p>Manfaatkan fitur tambahan poto agar produk semakin menarik untuk dilihat dari segala sudut, buat poto sudut samping kiri / kanan, atas atau penggunaan produk dll. 
                                        {{-- cek jika hanya poto produk yang diisi, maka berikan masukkan untuk menambahkan poto tambahan --}}
                                        @if (is_null($produk->poto_1) AND is_null($produk->poto_2) AND is_null($produk->poto_3))
                                            <a href="{{ url('/produk/'.Crypt::encryptString($produk->id).'/edit')}}" class="text-primary">tambahkan sekarang !</a></p>
                                        @endif
                                  </div>
                            </div>
                            <div class="col-md-4 text-center font-weight-bold p-2">
                                <section class="border p-2">
                                    <p>Poto Tambahan 1</p>
                                    @if (is_null($produk->poto_1))
                                        <strong class="text-danger">belum upload</strong>
                                        <img src="{{ asset('/img/market/photo.png')}}" alt="" class="img-fluid">
                                    @else
                                        <a href="{{ asset('/img/market/produk/'.$produk->poto_1)}}" target="_blank"><img src="{{ asset('/img/market/produk/'.$produk->poto_1)}}" alt="tidak ada" class="img-fluid"></a>
                                    @endif
                                </section>
                            </div>
                            <div class="col-md-4 text-center font-weight-bold p-2">
                                <section class="border p-2">
                                    <p>Poto Tambahan 2</p>
                                    @if (is_null($produk->poto_2))
                                        <strong class="text-danger">belum upload</strong>
                                        <img src="{{ asset('/img/market/photo.png')}}" alt="" class="img-fluid">
                                    @else
                                        <a href="{{ asset('/img/market/produk/'.$produk->poto_2)}}" target="_blank"><img src="{{ asset('/img/market/produk/'.$produk->poto_2)}}" alt="tidak ada" class="img-fluid"></a>
                                    @endif
                                </section>
                            </div>
                            <div class="col-md-4 text-center font-weight-bold p-2">
                                <section class="border p-2">
                                    <p>Poto Tambahan 3</p>
                                    @if (is_null($produk->poto_3))
                                        <strong class="text-danger">belum upload</strong>
                                        <img src="{{ asset('/img/market/photo.png')}}" alt="" class="img-fluid">
                                    @else
                                        <a href="{{ asset('/img/market/produk/'.$produk->poto_3)}}" target="_blank"><img src="{{ asset('/img/market/produk/'.$produk->poto_3)}}" alt="tidak ada" class="img-fluid"></a>
                                    @endif
                                </section>
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
                        <label for="" class="col-md-4 p-2">Diskon berapa % (0-100) <span class="text-danger">*</span></label>
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
                        <label for="" class="col-md-4 p-2">Diskon berapa % (0-100) <span class="text-danger">*</span></label>
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
