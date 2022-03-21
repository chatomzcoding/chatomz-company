@section('title')
    CHATOMZ - Data Kategori
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Kategori</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Kategori</li>
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
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Kategori </a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <form action="" method="get">
                  <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="label" id="label" class="form-control" onchange="this.form.submit()">
                                    <option value="semua">-- pilih label --</option>
                                    @foreach ($dlabel as $item)
                                        <option value="{{ $item->nama_kategori }}" @if ($main['filter']['label'] == $item->nama_kategori)
                                            selected
                                        @endif>{{ strtoupper($item->nama_kategori) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>    
                    </div>
                </form>  
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Aksi</th>
                                <th>Label</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($kategori as $item)
                            <tr>
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td class="text-center">
                                        <form id="data-{{ $item->id }}" action="{{url('/kategori',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            </form>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm btn-flat">Aksi</button>
                                                <button type="button" class="btn btn-info btn-sm btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <button type="button" data-toggle="modal"  data-nama_kategori="{{ $item->nama_kategori }}"  data-keterangan_kategori="{{ $item->keterangan_kategori }}"  data-label="{{ $item->label }}"  data-id="{{ $item->id }}" data-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                        <i class="fa fa-edit" style="width: 20px;"></i> EDIT
                                                    </button>
                                                <div class="dropdown-divider"></div>
                                                <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item text-danger"><i class="fas fa-trash-alt w20p"></i> HAPUS</button>
                                                </div>
                                            </div>
                                    </td>
                                    <td class="text-uppercase">{{ $item->label}}</td>
                                    <td>
                                        {{ $item->nama_kategori}}  <br> 
                                        @if (!is_null($item->gambar))
                                            <a href="{{ asset('img/kategori/'.$item->gambar) }}" target="_blank"><img src="{{ asset('img/kategori/'.$item->gambar) }}" alt="" width="150px"></a>
                                        @endif
                                    </td>
                                    <td>{{ $item->keterangan_kategori}}</td>
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
            <form action="{{ url('/kategori')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
            <h4 class="modal-title">Tambah Kategori</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Kategori {!! ireq() !!}</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                    <label for="" class="col-md-4">Label {!! ireq() !!}</label>
                    <select name="label" id="label" class="form-control col-md-8" required>
                        @foreach ($dlabel as $item)
                            <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                    </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Keterangan {!! ireq() !!}</label>
                       <textarea name="keterangan_kategori" id="keterangan_kategori" cols="30" rows="4" class="form-control col-md-8" required></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="form-control col-md-8">
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
            <form action="{{ route('kategori.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Kategori</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Nama Kategori {!! ireq() !!}</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                    <label for="" class="col-md-4">Label {!! ireq() !!}</label>
                    <select name="label" id="label" class="form-control col-md-8" required>
                        @foreach ($dlabel as $item)
                            <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                    </div>
                   <div class="form-group row">
                       <label for="" class="col-md-4">Keterangan {!! ireq() !!}</label>
                       <textarea name="keterangan_kategori" id="keterangan_kategori" cols="30" rows="4" class="form-control col-md-8" required></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Gambar (opsional)</label>
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
                var nama_kategori = button.data('nama_kategori')
                var label = button.data('label')
                var keterangan_kategori = button.data('keterangan_kategori')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_kategori').val(nama_kategori);
                modal.find('.modal-body #label').val(label);
                modal.find('.modal-body #keterangan_kategori').val(keterangan_kategori);
                modal.find('.modal-body #id').val(id);
            })
        </script>
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
