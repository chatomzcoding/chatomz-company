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
              <h1 class="m-0">Data Toko</h1>
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
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Toko Baru </a>
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
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Aksi</th>
                                <th>Logo</th>
                                <th>Nama Toko</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th>Pemilik</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($toko as $item)
                            <tr>
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td class="text-center">
                                        <form id="data-{{ $item->id }}" action="{{url('/toko',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            </form>
                                        <button type="button" data-toggle="modal" data-nama_toko="{{ $item->nama_toko }}" data-keterangan_toko="{{ $item->keterangan_toko }}" data-no_hp="{{ $item->no_hp }}" data-alamat_toko="{{ $item->alamat_toko }}" data-user_id="{{ $item->user_id }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-success btn-sm" data-original-title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                    <td class="text-center"><img src="{{ asset('/img/market/toko/'.$item->logo_toko)}}" alt="{{ $item->logo_toko}}" width="50px"></td>
                                    <td>{{ $item->nama_toko}}</td>
                                    <td>{{ $item->alamat_toko}}</td>
                                    <td>{{ $item->no_hp}}</td>
                                    <td>{{ DbChatomz::showtablefirst('users',['id',$item->user_id])->name}}</td>
                                    <td>{{ $item->keterangan_toko}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="6">tidak ada data</td>
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
            <form action="{{ url('/toko')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
            <h4 class="modal-title">Tambah Toko Baru</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama Toko</label>
                        <input type="text" name="nama_toko" id="nama_toko" class="form-control col-md-8" placeholder="Nama Toko" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Alamat Toko</label>
                        <input type="text" name="alamat_toko" id="alamat_toko" class="form-control col-md-8" placeholder="Alamat" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">No Hp Toko</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control col-md-8" placeholder="08xxxx" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Tentang Toko</label>
                        <input type="text" name="keterangan_toko" id="keterangan_toko" class="form-control col-md-8" placeholder="Tentang Toko" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Pemilik</label>
                        <select name="user_id" id="user_id" class="form-control col-md-8">
                            @foreach ($user as $item)
                                <option value="{{ $item->id}}">{{ $item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Logo</label>
                        <input type="file" name="logo_toko" id="profile_photo_path" class="form-control col-md-8" required>
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
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama Toko</label>
                        <input type="text" name="nama_toko" id="nama_toko" class="form-control col-md-8" placeholder="Nama Toko" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Alamat Toko</label>
                        <input type="text" name="alamat_toko" id="alamat_toko" class="form-control col-md-8" placeholder="Alamat" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">No Hp Toko</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control col-md-8" placeholder="08xxxx" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Tentang Toko</label>
                        <input type="text" name="keterangan_toko" id="keterangan_toko" class="form-control col-md-8" placeholder="Tentang Toko" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Pemilik</label>
                        <select name="user_id" id="user_id" class="form-control col-md-8">
                            @foreach ($user as $item)
                                <option value="{{ $item->id}}">{{ $item->name}}</option>
                            @endforeach
                        </select>
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

    @section('script')
        
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_toko = button.data('nama_toko')
                var keterangan_toko = button.data('keterangan_toko')
                var alamat_toko = button.data('alamat_toko')
                var no_hp = button.data('no_hp')
                var user_id = button.data('user_id')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_toko').val(nama_toko);
                modal.find('.modal-body #keterangan_toko').val(keterangan_toko);
                modal.find('.modal-body #alamat_toko').val(alamat_toko);
                modal.find('.modal-body #no_hp').val(no_hp);
                modal.find('.modal-body #user_id').val(user_id);
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
