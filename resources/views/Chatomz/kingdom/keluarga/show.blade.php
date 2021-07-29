@section('title')
    CHATOMZ - Data Keluarga {{ $keluarga->nama_keluarga}}
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Keluarga - {{ $keluarga->nama_keluarga}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('keluarga')}}">Daftar Keluarga</a></li>
                <li class="breadcrumb-item active">Daftar Anggota Keluarga</li>
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
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Anggota Keluarga </a>
                <a href="{{ url('/keluarga')}}" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-print"></i> Kembali ke daftar keluarga</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  {{-- <section class="text-right my-2">
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Data</button>
                  </section> --}}
                  {{-- <section class="mb-3">
                      <form action="" method="post">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <select name="" id="" class="form-control form-control-sm">
                                    <option value="">-- Semua --</option>
                                    @foreach (list_status() as $item)
                                        <option value="{{ $item}}">{{ $item}}</option>
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
                                <th>Hubungan Keluarga</th>
                                <th>Nama Anggota</th>
                                <th>Urutan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($keluargahubungan as $item)
                            <tr>
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td>{{ $item->status}}</td>
                                    <td><a href="{{ url('/orang/'.Crypt::encryptString($item->orang_id))}}">{{ $item->first_name.' '.$item->last_name}}</a> </td>
                                    <td class="text-center">{{ $item->urutan}}</td>
                                    <td>{{ $item->keterangan}}</td>
                                    <td class="text-center">
                                        <form id="data-{{ $item->id }}" action="{{url('/keluargahubungan',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            </form>
                                        {{-- <a href="{{ url('/keluargahubungan/'.Crypt::encryptString($item->id))}}" class="btn btn-primary btn-sm"><i class="fas fa-list"></i></a> --}}
                                        <button type="button" data-toggle="modal"  data-keluarga_id="{{ $item->keluarga_id }}" data-status="{{ $item->status }}" data-keterangan="{{ $item->keterangan }}" data-status="{{ $item->status }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-success btn-sm" data-original-title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </td>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                  <strong>Pohon Keluarga</strong>
              </div>
              <div class="card-body">
                {{-- baris kepala keluarga dan istri --}}
                <div class="row justify-content-center">
                    <div class="col-md-3 pb-0">
                        <div class="card bg-success mb-0">
                            <div class="row no-gutters">
                              <div class="col-md-4">
                                <a href="{{ url('/orang/'.Crypt::encryptString($pohon['istri']->idorang))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($pohon['istri']->photo))}}" class="card-img" alt="..."></a>
                              </div>
                              <div class="col-md-8">
                                <div class="card-body p-2">
                                  <small class="text-capitalize">{{ fullname($pohon['istri'])}}
                                    @if ($pohon['ortuistri'])
                                    <a href="{{ url('keluarga/'.Crypt::encryptString($pohon['ortuistri']->keluarga_id)) }}"><span><i class="fas fa-angle-up"></i></span></a>
                                   @endif
                                    <br>
                                  <i>istri</i></small>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-3 pb-0">
                        <div class="card bg-info mb-0">
                            <div class="row no-gutters">
                              <div class="col-md-4">
                                <a href="{{ url('/orang/'.Crypt::encryptString($pohon['suami']->id))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($pohon['suami']->photo))}}" class="card-img" alt="..."></a>
                              </div>
                              <div class="col-md-8">
                                <div class="card-body p-2">
                                    
                                    <small class="text-capitalize">{{ fullname($pohon['suami'])}} 
                                        {{-- cek keturunan keatas --}}
                                        @if ($pohon['ortusuami'])
                                         <a href="{{ url('keluarga/'.Crypt::encryptString($pohon['ortusuami']->keluarga_id)) }}"><span><i class="fas fa-angle-up"></i></span></a>
                                        @endif
                                    <br> <i>suami</i></small>
                                  </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
                {{-- garis keturunan --}}
                <div class="row justify-content-center">
                    <div class="col-md-3 akar-utama">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-3 akar-kiri">
                    </div>
                    <div class="col-md-3 akar-kanan">
                    </div>
                </div>
                @if (count($keluargahubungan) < 2)
                    <div class="row justify-content-center">
                        <div class="col-md-3 bg-secondary text-center small text-italic">
                            belum ada data
                        </div>
                    </div>
                @endif
                <div class="row justify-content-center">
                    @if (count($keluargahubungan) > 4)
                        @for ($i = 1; $i < 4; $i++)
                            <div class="col-md-3 akar-anak">
                            </div>
                        @endfor
                    @endif
                </div>
                <div class="row justify-content-center">
                    @foreach ($keluargahubungan as $item)
                        @if ($item->status <> 'istri')
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <a href="{{ url('/orang/'.Crypt::encryptString($item->idorang))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="..."></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body p-2">
                                        <small class="text-capitalize">{{ fullname($item)}}
                                            @php
                                                $keturunan = DbChatomz::cekketurunankeluarga($item->idorang,$item->gender);
                                            @endphp
                                            @if ($keturunan)
                                                <a href="{{ url('keluarga/'.Crypt::encryptString($keturunan)) }}"><span><i class="fas fa-angle-down"></i></span></a>
                                            @endif
                                            <br>
                                        <i>Anak {{ $item->urutan }}</i></small>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
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
    </div> --}}
    <!-- /.modal -->

    {{-- modal edit --}}
    {{-- <div class="modal fade" id="ubah">
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
                   <div class="form-group row">
                        <label for="" class="col-md-4">Status</label>
                        <select name="status" id="status" class="form-control col-md-8">
                            @foreach (list_status() as $item)
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
    </div> --}}
    <!-- /.modal -->

    @section('script')
        
        {{-- <script>
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
        </script> --}}
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
