@section('title')
    Admin - Daftar Iklan
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Iklan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Iklan</li>
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
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Iklan </a>
                {{-- <a href="#" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-print"></i> Hapus Data Terpilih</a> --}}
                {{-- <a href="{{ url('/artikel')}}" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-print"></i> Kembali ke artikel</a> --}}
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Aksi</th>
                                <th>Gambar</th>
                                <th>Nama Iklan</th>
                                <th>Deskripsi</th>
                                <th>Posisi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($iklan as $item)
                            <tr>
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td class="text-center">
                                        <form id="data-{{ $item->id }}" action="{{url('/iklan',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            </form>
                                        <button type="button" data-toggle="modal" data-nama_iklan="{{ $item->nama_iklan }}" data-deskripsi="{{ $item->deskripsi }}" data-status="{{ $item->status }}" data-posisi="{{ $item->posisi }}" data-link="{{ $item->link }}" data-teks_kecil="{{ $item->teks_kecil }}" data-teks_penting="{{ $item->teks_penting }}" data-nama_link="{{ $item->nama_link }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-success btn-sm" data-original-title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                    <td><img src="{{ asset('/img/admin/iklan/'.$item->gambar_iklan)}}" alt="" width="100px"></td>
                                    <td>{{ $item->nama_iklan}}</td>
                                    <td>{{ $item->deskripsi}}</td>
                                    <td>{{ $item->posisi}}</td>
                                    <td class="text-center">{{ $item->status}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">tidak ada data</td>
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
            <form action="{{ url('/iklan')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
            <h4 class="modal-title">Tambah Iklan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama Iklan<span class="text-danger">*</span></label>
                        <input type="text" name="nama_iklan" id="nama_iklan" class="form-control col-md-8" placeholder="Nama Iklan" value="{{ old('nama_iklan')}}" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Posisi Iklan<span class="text-danger">*</span></label>
                        <select name="posisi" id="posisi" class="form-control col-md-8" required>
                            <option value="">-- pilih posisi --</option>
                            @foreach (kingdom_posisiiklan() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Teks kecil tambahan</label>
                        <input type="text" name="teks_kecil" id="teks_kecil" class="form-control col-md-8" placeholder="Teks Kecil" value="{{ old('teks_kecil')}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Teks Penting tambahan</label>
                        <input type="text" name="teks_penting" id="teks_penting" class="form-control col-md-8" placeholder="Teks Kecil" value="{{ old('teks_penting')}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Link Tambahan</label>
                        <input type="url" name="link" id="link" class="form-control col-md-8" placeholder="https:://xxxx" value="{{ old('link')}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama button link</label>
                        <input type="text" name="nama_link" id="nama_link" class="form-control col-md-8" placeholder="simpan/klikdisini/dll" value="{{ old('nama_link')}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Deskripsi<span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control col-md-8" required>{{ old('deskripsi')}}</textarea>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Gambar Iklan<span class="text-danger">*</span></label>
                        <input type="file" name="gambar_iklan" id="gambar_iklan" class="form-control col-md-8" required>
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
            <form action="{{ route('iklan.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Iklan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama Iklan<span class="text-danger">*</span></label>
                        <input type="text" name="nama_iklan" id="nama_iklan" class="form-control col-md-8" placeholder="Nama Iklan" value="{{ old('nama_iklan')}}" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Posisi Iklan<span class="text-danger">*</span></label>
                        <select name="posisi" id="posisi" class="form-control col-md-8" required>
                            @foreach (kingdom_posisiiklan() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Status Iklan<span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control col-md-8" required>
                            @foreach (list_status() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Teks kecil tambahan</label>
                        <input type="text" name="teks_kecil" id="teks_kecil" class="form-control col-md-8" placeholder="Teks Kecil" value="{{ old('teks_kecil')}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Teks Penting tambahan</label>
                        <input type="text" name="teks_penting" id="teks_penting" class="form-control col-md-8" placeholder="Teks Kecil" value="{{ old('teks_penting')}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Link Tambahan</label>
                        <input type="url" name="link" id="link" class="form-control col-md-8" placeholder="https:://xxxx" value="{{ old('link')}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama button link</label>
                        <input type="text" name="nama_link" id="nama_link" class="form-control col-md-8" placeholder="simpan/klikdisini/dll" value="{{ old('nama_link')}}">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Deskripsi<span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control col-md-8" required>{{ old('deskripsi')}}</textarea>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Gambar Iklan<span class="text-danger">unggah jika ingin merubah</span></label>
                        <input type="file" name="gambar_iklan" id="gambar_iklan" class="form-control col-md-8">
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
                var nama_iklan = button.data('nama_iklan')
                var deskripsi = button.data('deskripsi')
                var posisi = button.data('posisi')
                var nama_link = button.data('nama_link')
                var link = button.data('link')
                var teks_kecil = button.data('teks_kecil')
                var teks_penting = button.data('teks_penting')
                var status = button.data('status')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_iklan').val(nama_iklan);
                modal.find('.modal-body #deskripsi').val(deskripsi);
                modal.find('.modal-body #posisi').val(posisi);
                modal.find('.modal-body #teks_kecil').val(teks_kecil);
                modal.find('.modal-body #teks_penting').val(teks_penting);
                modal.find('.modal-body #nama_link').val(nama_link);
                modal.find('.modal-body #link').val(link);
                modal.find('.modal-body #status').val(status);
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
