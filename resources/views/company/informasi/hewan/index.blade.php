<x-mazer-layout title="DUNIA HEWAN" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header judul="Data Informasi Hewan" active="Daftar Hewan">

            </x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Hewan </a>
                        </div>
                        <div class="card-body">
                              <div class="row d-flex align-items-stretch">
                                  @foreach ($data as $item)
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
                                              <p class="small"><b>{{ DbChatomz::countData('informasi_sub',['informasi_id',$item->id]) }}</b></p>
                                              <p class="text-muted text-sm text-justify">{{ Str::substr($detail->tentang, 0, 100)}}. . . </p>
                                              <ul class="ml-4 mb-0 fa-ul text-muted">
                                                  <li class="small"><span class="fa-li"></li>
                                              </ul>
                                              </div>
                                          </div>
                                          </div>
                                          <div class="card-footer bg-secondary">
                                          <div class="text-right">
                                              <form id="data-{{ $item->id }}" action="{{url('/informasi',$item->id)}}" method="post">
                                                  @csrf
                                                  @method('delete')
                                              </form>
                                              <a href="{{ url('/informasi/'.$item->id)}}" class="btn btn-sm btn-outline-light">
                                                  <i class="fas fa-list"></i>
                                              </a>
                                                  <button type="button" data-bs-toggle="modal"  data-nama="{{ $item->nama }}"  data-nama_latin="{{ $item->nama_latin }}"  data-tentang="{{ $item->tentang }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="btn btn-outline-light btn-sm" data-original-title="Edit Task">
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
        </div>
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
    </x-slot>
    <x-slot name="kodejs">
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

    </x-slot>
</x-mazer-layout>