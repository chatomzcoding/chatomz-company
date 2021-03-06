@section('title')
    CHATOMZ - Daftar Keluarga
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Keluarga</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Tambah Keluarga Baru</li>
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
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Keluarga </a>
                {{-- <a href="{{ url('/orang/create')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Tambah Orang Baru </a> --}}
                {{-- <a href="#" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-print"></i> Cetak</a> --}}
                {{-- <a href="#" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-print"></i> Unduh</a> --}}
                {{-- <a href="#" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-sync"></i> Bersihkan Filter</a> --}}
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <section class="p-3">
                    <div class="form-group row">
                         <label for="" class="col-md-4">Nama Keluarga</label>
                         <input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control col-md-8" required>
                    </div>
                    <div class="form-group row">
                     <label for="" class="col-md-4">Kepala Keluarga</label>
                     <select name="orang_id" id="orang_id" class="form-control col-md-8">
                         @foreach ($kepalakeluarga as $item)
                             <option value="{{ $item->id}}">{{ $item->first_name.' '.$item->last_name}}</option>
                         @endforeach
                     </select>
                     </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">No KK</label>
                         <input type="text" name="no_kk" id="no_kk" class="form-control col-md-8">
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Tanggal Pernikahan</label>
                         <input type="date" name="tgl_pernikahan" id="tgl_pernikahan" class="form-control col-md-8">
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Keterangan</label>
                         <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8">
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Status Keluarga</label>
                         <select name="status_keluarga" id="status_keluarga" class="form-control col-md-8">
                             @foreach (kingdom_statuskeluarga() as $item)
                                 <option value="{{ $item}}">{{ $item}}</option>
                             @endforeach
                         </select>
                    </div>
                 </section>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- modal --}}
    {{-- modal tambah --}}
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/keluarga')}}" method="post">
                @csrf
            <div class="modal-header">
            <h4 class="modal-title">Tambah Keluarga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Keluarga</label>
                        <input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                    <label for="" class="col-md-4">Kepala Keluarga</label>
                    <select name="orang_id" id="orang_id" class="form-control col-md-8">
                        @foreach ($kepalakeluarga as $item)
                            <option value="{{ $item->id}}">{{ $item->first_name.' '.$item->last_name}}</option>
                        @endforeach
                    </select>
                    </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">No KK</label>
                        <input type="text" name="no_kk" id="no_kk" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tanggal Pernikahan</label>
                        <input type="date" name="tgl_pernikahan" id="tgl_pernikahan" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Status Keluarga</label>
                        <select name="status_keluarga" id="status_keluarga" class="form-control col-md-8">
                            @foreach (kingdom_statuskeluarga() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
                        </select>
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

    {{-- modal edit --}}
    <div class="modal fade" id="ubah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('keluarga.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Keluarga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Nama Keluarga</label>
                        <input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                    <label for="" class="col-md-4">Kepala Keluarga</label>
                    <select name="orang_id" id="orang_id" class="form-control col-md-8">
                        @foreach ($kepalakeluarga as $item)
                            <option value="{{ $item->id}}">{{ $item->first_name.' '.$item->last_name}}</option>
                        @endforeach
                    </select>
                    </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">No KK</label>
                        <input type="text" name="no_kk" id="no_kk" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tanggal Pernikahan</label>
                        <input type="date" name="tgl_pernikahan" id="tgl_pernikahan" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Status Keluarga</label>
                        <select name="status_keluarga" id="status_keluarga" class="form-control col-md-8">
                            @foreach (kingdom_statuskeluarga() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
                        </select>
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
