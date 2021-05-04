@section('title')
    CHATOMZ - Tambah Orang
@endsection

<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Orang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('orang')}}">Daftar Orang</a></li>
                <li class="breadcrumb-item active">Tambah Orang</li>
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
                {{-- <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Klasifikasi Baru </a> --}}
                <a href="{{ url('/orang')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Kembali </a>
                {{-- <a href="#" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-print"></i> Cetak</a> --}}
                {{-- <a href="#" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-print"></i> Unduh</a> --}}
                {{-- <a href="#" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-sync"></i> Bersihkan Filter</a> --}}
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <form method="post" action="{{ url('/orang')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Nama Awal</label>
                                    <input type="text" class="form-control col-md-8" name="first_name" value="{{ old('first_name')}}" id="inlineinput" >
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Nama Akhir</label>
                                    <input type="text" class="form-control col-md-8" name="last_name" value="{{ old('last_name')}}" id="inlineinput">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Nama Panggilan</label>
                                    <input type="text" class="form-control col-md-8" name="nick_name" value="{{ old('nick_name')}}" id="inlineinput">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Alamat Rumah</label>
                                    <textarea name="home_address" id="" cols="30" rows="3" class="form-control col-md-8">{{ old('home_address')}}</textarea>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Alamat Sekarang</label>
                                    <textarea name="current_address" id="" cols="30" rows="3" class="form-control col-md-8">{{ old('current_address')}}</textarea>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Tempat Lahir</label>
                                    <input type="text" name="place_birth" class="form-control col-md-8" id="inlineinput"  value="{{ old('place_birth')}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Tanggal Lahir</label>
                                    <input type="date" name="date_birth" class="form-control col-md-8" id="inlineinput" value="{{ old('date_birth')}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Pekerjaan</label>
                                    <input type="text" name="job_status" class="form-control col-md-8"  value="{{ old('job_status')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Jenis Kelamin</label>
                                    <select name="gender" id="" class="form-control col-md-8">
                                        <option value="male">Laki - laki</option>
                                        <option value="female">Perempuan</option>
                                        <option value="other">Lainnya</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Kebangsaan</label>
                                    <select name="nasionality" id="" class="form-control col-md-8">
                                        @foreach (countryname() as $item)
                                        <option value="{{ $item }}" >{{ $item }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Agama</label>
                                    <select name="religion" id="" class="form-control col-md-8">
                                        <option value="islam">Islam</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Golongan Darah</label>
                                    <select name="blood_type" id="" class="form-control col-md-8">
                                        <option value="none" >none</option>
                                        <option value="a" >A</option>
                                        <option value="b" >B</option>
                                        <option value="ab" >AB</option>
                                        <option value="o">O</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Status Perkawinan</label>
                                    <select name="marital_status" id="" class="form-control col-md-8">
                                        <option value="single" >Belum Kawin</option>
                                        <option value="married">Sudah Kawin</option>
                                        <option value="ever been married">Pernah Kawin</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Status Grup</label>
                                    <select name="status_group" id="" class="form-control col-md-8">
                                        <option value="available" >Tersedia</option>
                                        <option value="full" >Ditutup</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Status Kematian</label>
                                    <select name="death" id="" class="form-control col-md-8">
                                        <option value="">Masih Hidup</option>
                                        <option value="alm" >Meninggal</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Catatan</label>
                                    <input type="text" name="note" class="form-control col-md-8" id="inlineinput" value="{{ old('note')}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Photo</label>
                                    <input type="file" name="photo">
                            </div>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </form>
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
            <form action="{{ url('/orang')}}" method="post">
                @csrf
            <div class="modal-header">
            <h4 class="modal-title">Tambah Data Klasifikasi Surat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8" required>
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
            <form action="{{ route('orang.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Klasifikasi Surat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8" required>
                   </div>
                   {{-- <div class="form-group row">
                        <label for="" class="col-md-4">Status</label>
                        <select name="status" id="status" class="form-control col-md-8">
                            @foreach (list_status() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
                        </select>
                   </div> --}}
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
                var kode = button.data('kode')
                var keterangan = button.data('keterangan')
                var status = button.data('status')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #kode').val(kode);
                modal.find('.modal-body #keterangan').val(keterangan);
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
