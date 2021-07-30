@section('title')
    CHATOMZ - Daftar Grup {{ $grup->name}}
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Grup</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('grup')}}">Daftar Grup</a></li>
                <li class="breadcrumb-item active">Grup {{ $grup->name}}</li>
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
                <a href="{{ url('/grup')}}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-angle-left"></i> kembali </a>
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Anggota Grup </a>
                {{-- <a href="#" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-print"></i> Cetak</a> --}}
                {{-- <a href="#" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-print"></i> Unduh</a> --}}
                {{-- <a href="#" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-sync"></i> Bersihkan Filter</a> --}}
                <span class="float-right">Total Anggota {{ count($anggota) }}</span>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  {{-- <section class="text-right my-2">
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Data</button>
                  </section> --}}
                    <div class="row d-flex align-items-stretch">
                        @foreach ($anggota as $item)
                            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0 text-capitalize">
                                {{ fullname($item)}}
                                </div>
                                <div class="card-body pt-0 pb-0">
                                <div class="row">
                                    <div class="col-7">
                                    <h2 class="lead"><b>{{ $item->gender}}</b></h2>
                                    </div>
                                    <div class="col-5 text-center">
                                        <a href="{{ url('/orang/'.Crypt::encryptString($item->orang_id))}}"><img src="{{ asset('/img/chatomz/orang/'.$item->photo)}}" alt="user-avatar" class="img-fluid img-circle"></a>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="small">{{ $item->information }}</span>
                                    </div>
                                </div>
                                </div>
                                <div class="card-footer p-1">
                                    <form id="data-{{ $item->id }}" action="{{url('/grupanggota',$item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                        <span class="text-muted text-sm text-justify"><i class="fas fa-calendar-alt"></i> {{ $item->created_at }} </span> <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-outline-danger btn-sm float-right"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                            </div>
                        @endforeach
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
            <form action="{{ url('/grupanggota')}}" method="post">
                @csrf
                <input type="hidden" name="grup_id" value="{{ $grup->id }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Anggota Grup</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                    <label for="" class="col-md-4">Nama Anggota</label>
                    <select name="orang_id" id="orang_id" class="form-control col-md-8">
                        @foreach ($orang as $item)
                            @if (!DbChatomz::cekstatusgrup($grup->id,$item->id))
                                <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="information" id="information" class="form-control col-md-8">
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
                   {{-- <div class="form-group row">
                    <label for="" class="col-md-4">Kepala Keluarga</label>
                    <select name="orang_id" id="orang_id" class="form-control col-md-8">
                        @foreach ($kepalakeluarga as $item)
                            <option value="{{ $item->id}}">{{ $item->first_name.' '.$item->last_name}}</option>
                        @endforeach
                    </select>
                    </div> --}}
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
