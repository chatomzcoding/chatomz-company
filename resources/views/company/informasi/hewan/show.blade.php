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
              <h1 class="m-0">Data Hewan Jenis {{ $hewan->nama }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('hewan')}}">Daftar Hewan</a></li>
                <li class="breadcrumb-item active">Jenis-Jenis {{ $hewan->nama }}</li>
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
                <a href="{{ url('/hewan')}}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-angle-left"></i> kembali </a>
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Jenis </a>
                
                {{-- <a href="#" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-sync"></i> Bersihkan Filter</a> --}}
                <span class="float-right font-italic">{{ count($jenis)}} jenis {{ $hewan->nama}}</span>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  {{-- <section class="text-right my-2">
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Data</button>
                  </section> --}}
                    <div class="row d-flex align-items-stretch">
                        @foreach ($jenis as $item)
                            <div class="col-12 col-sm-4 col-md-3 d-flex align-items-stretch">
                            <div class="card bg-light">
                                <!--<div class="card-header text-muted border-bottom-0 font-weight-bold">-->
                                <!--{{ ucwords($item->nama_jenis)}} -->
                                <!--@if (!empty($item->nama_latin_jenis))-->
                                <!--    <i>({{ $item->nama_latin_jenis}})</i>-->
                                <!--@endif-->
                                <!--</div>-->
                                <div class="card-body pt-0 px-0 pb-0">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="{{ asset('img/company/informasi/hewan/'.$item->gambar_jenis)}}" target="_blank"><img src="{{ asset('img/company/informasi/hewan/'.$item->gambar_jenis)}}" alt="user-avatar" class="img-fluid rounded-top"></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 px-2 pt-2 pb-0">
                                        <div class="p-2">
                                            <strong>
                                                {{ ucwords($item->nama_jenis)}} 
                                                @if (!empty($item->nama_latin_jenis))
                                                    <i>({{ $item->nama_latin_jenis}})</i>
                                                @endif
                                            </strong>
                                        <p class="text-muted text-sm text-justify">{{ Str::substr($item->tentang_jenis, 0, 130)}}. . . </p>    
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="card-footer p-0">
                                     <ul class="list-group list-group-horizontal text-center p-0 rounded-0">
                                        <li class="list-group-item w-100 p-1 rounded-0"><i class="fas fa-utensils text-success"></i> <br> <span class="text-secondary small"> {{ $item->pemakan }}</span></li>
                                        <li class="list-group-item w-100 p-1 rounded-0"><i class="fas fa-bezier-curve text-primary"></i> <br> <span class="text-secondary small"> {{ $item->klasifikasi }}</span></li>
                                        <li class="list-group-item w-100 p-1 rounded-0"><i class="fas fa-heartbeat text-danger"></i> <br> 
                                            @if (!empty($item->lama_hidup))
                                                <span class="text-secondary small">{{ $item->lama_hidup }}</span>
                                            @else
                                                <span class="text-secondary small">-</span>
                                            @endif
                                        </li>
                                    </ul>
                                    <div class="text-right bg-secondary p-1 rounded-bottom">
                                        <form id="data-{{ $item->id }}" action="{{url('/hewanjenis',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                            <button type="button" data-toggle="modal"  data-nama_jenis="{{ $item->nama_jenis }}"  data-nama_latin_jenis="{{ $item->nama_latin_jenis }}"  data-tentang_jenis="{{ $item->tentang_jenis }}" data-pemakan="{{ $item->pemakan }}" data-klasifikasi="{{ $item->klasifikasi }}" data-lama_hidup="{{ $item->lama_hidup }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-outline-light btn-sm" data-original-title="Edit Task">
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
            <form action="{{ url('/hewanjenis')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="hewan_id" value="{{ $hewan->id }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Jenis {{ $hewan->nama }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Hewan</label>
                        <input type="text" name="nama_jenis" id="nama_jenis" class="form-control col-md-8" value="{{ old('nama_jenis')}}" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Latin</label>
                        <input type="text" name="nama_latin_jenis" id="nama_latin_jenis" class="form-control col-md-8"  value="{{ old('nama_latin_jenis')}}">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Lama Hidup</label>
                        <input type="text" name="lama_hidup" id="lama_hidup" class="form-control col-md-8"  value="{{ old('lama_hidup')}}">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Jenis Pemakan</label>
                        <select name="pemakan" id="pemakan" class="form-control col-md-8">
                            @foreach (list_hewanpemakan() as $item => $isi)
                                <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                            @endforeach
                        </select>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Klasifikasi Hewan</label>
                        <select name="klasifikasi" id="klasifikasi" class="form-control col-md-8">
                            @foreach (list_klasifikasihewan() as $item => $isi)
                                <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                            @endforeach
                        </select>
                   </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Tentang</label>
                       <input type="text" name="tentang_jenis" id="tentang_jenis" class="form-control col-md-8"  value="{{ old('tentang_jenis')}}" required>
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Gambar</label>
                         <input type="file" name="gambar_jenis" id="gambar_jenis" class="form-control col-md-8" required>
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
            <form action="{{ route('hewanjenis.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Jenis Hewan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Nama Hewan</label>
                        <input type="text" name="nama_jenis" id="nama_jenis" class="form-control col-md-8" value="{{ old('nama_jenis')}}" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Latin</label>
                        <input type="text" name="nama_latin_jenis" id="nama_latin_jenis" class="form-control col-md-8"  value="{{ old('nama_latin_jenis')}}">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Lama Hidup</label>
                        <input type="text" name="lama_hidup" id="lama_hidup" class="form-control col-md-8"  value="{{ old('lama_hidup')}}">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Jenis Pemakan</label>
                        <select name="pemakan" id="pemakan" class="form-control col-md-8">
                            @foreach (list_hewanpemakan() as $item => $isi)
                                <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                            @endforeach
                        </select>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Klasifikasi Hewan</label>
                        <select name="klasifikasi" id="klasifikasi" class="form-control col-md-8">
                            @foreach (list_klasifikasihewan() as $item => $isi)
                                <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                            @endforeach
                        </select>
                   </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Tentang</label>
                       <input type="text" name="tentang_jenis" id="tentang_jenis" class="form-control col-md-8"  value="{{ old('tentang_jenis')}}" required>
                    </div>
                    <div class="form-group row">
                         <label for="" class="col-md-4">Gambar</label>
                         <input type="file" name="gambar_jenis" id="gambar_jenis" class="form-control col-md-8">
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
                var nama_jenis = button.data('nama_jenis')
                var nama_latin_jenis = button.data('nama_latin_jenis')
                var tentang_jenis = button.data('tentang_jenis')
                var pemakan = button.data('pemakan')
                var lama_hidup = button.data('lama_hidup')
                var klasifikasi = button.data('klasifikasi')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_jenis').val(nama_jenis);
                modal.find('.modal-body #nama_latin_jenis').val(nama_latin_jenis);
                modal.find('.modal-body #tentang_jenis').val(tentang_jenis);
                modal.find('.modal-body #pemakan').val(pemakan);
                modal.find('.modal-body #lama_hidup').val(lama_hidup);
                modal.find('.modal-body #klasifikasi').val(klasifikasi);
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
