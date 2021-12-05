@section('title')
    Company - Informasi Hewan
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Informasi Hewan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Hewan</li>
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
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Hewan </a>
                {{-- <a href="{{ url('/orang/create')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Tambah Orang Baru </a> --}}
                {{-- <a href="#" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-sync"></i> Bersihkan Filter</a> --}}
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  {{-- <section class="text-right my-2">
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Data</button>
                  </section> --}}
                    <div class="row d-flex align-items-stretch">
                        @foreach ($hewan as $item)
                            <div class="col-12 col-sm-4 col-md-3 d-flex align-items-stretch">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0 font-weight-bold">
                                {{ ucwords($item->nama)}}
                                @php
                                    $detail = json_decode($item->detail); 
                                @endphp
                                @if (isset($detail->nama_latin))
                                    <i>({{ $detail->nama_latin}})</i>
                                @endif
                                </div>
                                <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                    <a href="{{ asset('img/company/informasi/hewan/'.$item->gambar)}}" target="_blank"><img src="{{ asset('img/company/informasi/hewan/'.$item->gambar)}}" alt="user-avatar" class="img-fluid img-rounded"></a>
                                    </div>
                                    <div class="col-md-12">
                                    <p class="small"><b>0</b></p>
                                    <p class="text-muted text-sm text-justify">{{ Str::substr($detail->tentang, 0, 100)}}. . . </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"></li>
                                        {{-- <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li> --}}
                                    </ul>
                                    </div>
                                </div>
                                </div>
                                <div class="card-footer bg-secondary">
                                <div class="text-right">
                                    {{-- <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                    </a> --}}
                                    <form id="data-{{ $item->id }}" action="{{url('/hewan',$item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <a href="{{ url('/hewan/'.Crypt::encryptString($item->id))}}" class="btn btn-sm btn-outline-light">
                                        <i class="fas fa-list"></i>
                                    </a>
                                        <button type="button" data-toggle="modal"  data-nama="{{ $item->nama }}"  data-nama_latin="{{ $item->nama_latin }}"  data-tentang="{{ $item->tentang }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-outline-light btn-sm" data-original-title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-outline-light btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </div>
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
            <form action="{{ url('/hewan')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
            <h4 class="modal-title">Tambah Hewan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Hewan</label>
                        <input type="text" name="nama" id="nama" class="form-control col-md-8" value="{{ old('nama')}}" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Latin</label>
                        <input type="text" name="nama_latin" id="nama_latin" class="form-control col-md-8"  value="{{ old('nama_latin')}}">
                   </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Tentang</label>
                       <input type="text" name="tentang" id="tentang" class="form-control col-md-8"  value="{{ old('tentang')}}" required>
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Gambar</label>
                         <input type="file" name="gambar" id="gambar" class="form-control col-md-8" required>
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
            <form action="{{ route('hewan.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Hewan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Nama Hewan</label>
                        <input type="text" name="nama" id="nama" class="form-control col-md-8" value="{{ old('nama')}}" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Latin</label>
                        <input type="text" name="nama_latin" id="nama_latin" class="form-control col-md-8"  value="{{ old('nama_latin')}}">
                   </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Tentang</label>
                       <input type="text" name="tentang" id="tentang" class="form-control col-md-8"  value="{{ old('tentang')}}" required>
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Gambar</label>
                         <input type="file" name="gambar" id="gambar" class="form-control col-md-8">
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
                var nama = button.data('nama')
                var nama_latin = button.data('nama_latin')
                var tentang = button.data('tentang')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #nama_latin').val(nama_latin);
                modal.find('.modal-body #tentang').val(tentang);
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
