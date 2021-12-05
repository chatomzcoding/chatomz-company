@section('title')
    CHATOMZ - Daftar Jejak
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Jejak Kehidupan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Jejak</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>

    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Jejak </a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Tanggal</th>
                                <th>Nama Jejak</th>
                                <th>kategori</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($jejak as $item)
                            <tr>
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td>{{ date_indo($item->tanggal,'-')}}</td>
                                    <td>{{ $item->nama_jejak}}</td>
                                    <td>{{ $item->kategori}}</td>
                                    <td class="text-center">
                                        <form id="data-{{ $item->id }}" action="{{url('/jejak',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            </form>
                                        <a href="{{ url('jejak/'.Crypt::encryptString($item->id)) }}" class="btn btn-primary btn-sm"><i class="fas fa-file"></i></a>
                                        <button type="button" data-toggle="modal"  data-nama_jejak="{{ $item->nama_jejak }}"  data-tanggal="{{ $item->tanggal }}"  data-nilai_lat="{{ $item->nilai_lat }}" data-nilai_long="{{ $item->nilai_long }}" data-keterangan_jejak="{{ $item->keterangan_jejak }}" data-kategori="{{ $item->kategori }}" data-lokasi="{{ $item->lokasi }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-success btn-sm" data-original-title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">tidak ada data</td>
                                </tr>
                            @endforelse
                    </table>
                </div>
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
            <form action="{{ url('/jejak')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
            <h4 class="modal-title">Tambah Jejak</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Jejak</label>
                        <input type="text" name="nama_jejak" id="nama_jejak" class="form-control col-md-8" value="{{ old('nama_jejak') }}" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tanggal Jejak</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control col-md-8" value="{{ old('tanggal') }}">
                   </div>
                   <div class="form-group row">
                    <label for="" class="col-md-4">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control col-md-8" required>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->nama_kategori}}">{{ strtoupper($item->nama_kategori)}}</option>
                        @endforeach
                    </select>
                    </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control col-md-8" value="{{ old('lokasi') }}" required>
                   </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Keterangan</label>
                       <textarea name="keterangan_jejak" id="keterangan_jejak" cols="30" rows="4" class="form-control col-md-8" required>{{ old('keterangan_jejak') }}</textarea>
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Gambar</label>
                         <input type="file" name="gambar_jejak" id="nilai_long" class="form-control col-md-8">
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
            <form action="{{ route('jejak.update','test')}}" method="post" enctype="multipart/form-data">
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
                        <label for="" class="col-md-4">Nama Jejak</label>
                        <input type="text" name="nama_jejak" id="nama_jejak" class="form-control col-md-8" value="{{ old('nama_jejak') }}" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tanggal Jejak</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control col-md-8" value="{{ old('tanggal') }}">
                   </div>
                   <div class="form-group row">
                    <label for="" class="col-md-4">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control col-md-8" required>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->nama_kategori}}">{{ strtoupper($item->nama_kategori)}}</option>
                        @endforeach
                    </select>
                    </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control col-md-8" value="{{ old('lokasi') }}" required>
                   </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Keterangan</label>
                       <textarea name="keterangan_jejak" id="keterangan_jejak" cols="30" rows="4" class="form-control col-md-8" required>{{ old('keterangan_jejak') }}</textarea>
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Gambar</label>
                         <input type="file" name="gambar_jejak" id="nilai_long" class="form-control col-md-8">
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

    @section('script')
        
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_keluarga = button.data('nama_keluarga')
                var no_kk = button.data('no_kk')
                var tgl_pernikahan = button.data('tgl_pernikahan')
                var keterangan = button.data('keterangan')
                var status_keluarga = button.data('status_keluarga')
                var orang_id = button.data('orang_id')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_keluarga').val(nama_keluarga);
                modal.find('.modal-body #no_kk').val(no_kk);
                modal.find('.modal-body #tgl_pernikahan').val(tgl_pernikahan);
                modal.find('.modal-body #keterangan').val(keterangan);
                modal.find('.modal-body #status_keluarga').val(status_keluarga);
                modal.find('.modal-body #orang_id').val(orang_id);
                modal.find('.modal-body #id').val(id);
            })
        </script>
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            });
        </script>
    @endsection

</x-app-layout>
