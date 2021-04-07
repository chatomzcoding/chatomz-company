@section('title')
    Market - Data Toko
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Toko {{ $toko->nama_toko}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Toko</li>
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
                <a href="#" class="btn btn-outline-success btn-flat btn-sm" data-toggle="modal" data-target="#edit"><i class="fas fa-pen"></i> Edit Toko </a>
                {{-- <a href="#" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-print"></i> Hapus Data Terpilih</a> --}}
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
                    <div class="row">
                        <div class="col-md-4">
                            <section class="p-2">
                                <img src="{{ asset('/img/market/toko/'.$toko->logo_toko)}}" alt="" class="img-fluid">
                            </section>
                        </div>
                        <div class="col-md-8">
                            <hr>
                            <section class="p-2">
                                <div class="row">
                                    <div class="col-md-4 font-weight-bold">
                                        <p>Nama Toko :</p>
                                    </div>
                                    <div class="col-md-8 pl-3">
                                        <p>{{ $toko->nama_toko}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 font-weight-bold">
                                        <p>Pemilik Toko : </p>
                                    </div>
                                    <div class="col-md-8 pl-3">
                                        <p>{{ DbChatomz::showtablefirst('users',['id',$toko->user_id])->name}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 font-weight-bold">
                                        <p>Alamat Toko :</p>
                                    </div>
                                    <div class="col-md-8 pl-3">
                                        <p>{{ $toko->alamat_toko}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 font-weight-bold">
                                        <p>Deskripsi Toko :</p>
                                    </div>
                                    <div class="col-md-8 pl-3">
                                        <p>{{ $toko->keterangan_toko}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 font-weight-bold">
                                        <p>No Telp Toko :</p>
                                    </div>
                                    <div class="col-md-8 pl-3">
                                        <p>{{ $toko->no_hp}} <br> <i class="text-danger">nomor ini penting untuk pesan produk lewat whatsapp</i></p>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- modal --}}

    {{-- modal edit --}}
    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('toko.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Toko</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" value="{{ $toko->id}}">
                <input type="hidden" name="user_id" value="{{ $toko->user_id}}">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama Toko<span class="text-danger">*</span></label>
                        <input type="text" name="nama_toko" value="{{ $toko->nama_toko}}" class="form-control col-md-8" placeholder="Nama Toko" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Alamat Toko<span class="text-danger">*</span></label>
                        <input type="text" name="alamat_toko" id="alamat_toko"  value="{{ $toko->alamat_toko}}" class="form-control col-md-8" placeholder="Alamat" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">No Hp Toko<span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control col-md-8" value="{{ $toko->no_hp}}" placeholder="08xxxx" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Tentang Toko<span class="text-danger">*</span></label>
                        <input type="text" name="keterangan_toko" id="keterangan_toko" class="form-control col-md-8"  value="{{ $toko->keterangan_toko}}" placeholder="Tentang Toko" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Logo (unggah jika ingin mengubah)</label>
                        <input type="file" name="logo_toko" id="profile_photo_path" class="form-control col-md-8">
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
</x-app-layout>
