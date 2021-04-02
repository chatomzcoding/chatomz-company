@section('title')
    ADMIN - Artikel
@endsection
<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Artikel</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Artikel</li>
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
          <div class="col-md-3">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kategori Artikel</h3>
              </div>
              <div class="card-body">
                  <section class="mb-3">
                      <ul>
                          @foreach ($kategori as $item)
                              <li>{{ $item->nama_kategori}}</li>
                          @endforeach
                      </ul>
                  </section>
                  <a href="{{ url('/kategoriartikel')}}" class="btn btn-primary btn-sm btn-block">Kelola Kategori Artikel</a>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                {{-- <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Artikel </a> --}}
                <a href="{{ url('/artikel/create')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Tambah Artikel </a>
                <a href="#" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-print"></i> Cetak</a>
                <a href="#" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-print"></i> Unduh</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  {{-- <section class="mb-3">
                      <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <select name="" id="" class="form-control form-control-sm">
                                    <option value="">Kategori Kelompok</option>
                                    @foreach ($kategorikelompok as $item)
                                        <option value="{{ $item->id}}">{{ $item->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                  </section> --}}
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Aksi</th>
                                <th>Gambar</th>
                                <th>Judul Artikel</th>
                                <th>Kategori</th>
                                <th>Dilihat</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($artikel as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration}}</td>
                                <td class="text-center">
                                    <form id="data-{{ $item->id }}" action="{{url('/artikel',$item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        </form>
                                    <a href="{{ url('/artikel/'.Crypt::encryptString($item->id).'/edit')}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
                                    <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </td>
                                <td><img src="{{ asset('/img/admin/artikel/'.$item->gambar_artikel)}}" alt="" width="100px"></td>
                                <td>{{ $item->judul_artikel}}</td>
                                <td>{{ $item->nama_kategori}}</td>
                                <td class="text-center">{{ $item->view}}</td>
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
    {{-- <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/kelompok')}}" method="post">
                @csrf
            <div class="modal-header">
            <h4 class="modal-title">Tambah Data Kelompok</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group">
                        <label for="">Nama Kelompok</label>
                        <input type="text" id="nama_kelompok" name="nama_kelompok" class="form-control" placeholder="Nama Kelompok" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Kelompok</label>
                        <input type="text" id="kode_kelompok" name="kode_kelompok" class="form-control" placeholder="Kode Kelompok" required>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Kelompok</label>
                        <textarea name="deskripsi_kelompok" id="deskripsi_kelompok" cols="30" rows="4" class="form-control"></textarea>
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
    </div> --}}
    <!-- /.modal -->

    {{-- modal edit --}}
    {{-- <div class="modal fade" id="ubah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('kelompok.update','test')}}" method="post">
                @csrf
                @method('patch')
                <input type="hidden" name="logo_unit" value="">
            <div class="modal-header">
            <h4 class="modal-title">Edit Kelompok</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group">
                        <label for="">Nama Kelompok</label>
                        <input type="text" id="nama_kelompok" name="nama_kelompok" class="form-control" placeholder="Nama Kelompok" required>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Kelompok</label>
                        <input type="text" id="kode_kelompok" name="kode_kelompok" class="form-control" placeholder="Kode Kelompok" required>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Kelompok</label>
                        <textarea name="deskripsi_kelompok" id="deskripsi_kelompok" cols="30" rows="4" class="form-control"></textarea>
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
    </div> --}}
    <!-- /.modal -->

    @section('script')
        
        {{-- <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_kelompok = button.data('nama_kelompok')
                var kode_kelompok = button.data('kode_kelompok')
                var penduduk_id = button.data('penduduk_id')
                var kategorikelompok_id = button.data('kategorikelompok_id')
                var deskripsi_kelompok = button.data('deskripsi_kelompok')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_kelompok').val(nama_kelompok);
                modal.find('.modal-body #kode_kelompok').val(kode_kelompok);
                modal.find('.modal-body #penduduk_id').val(penduduk_id);
                modal.find('.modal-body #kategorikelompok_id').val(kategorikelompok_id);
                modal.find('.modal-body #deskripsi_kelompok').val(deskripsi_kelompok);
                modal.find('.modal-body #id').val(id);
            })
        </script> --}}
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
