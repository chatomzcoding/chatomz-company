<x-mazer-layout title="Company - Data Gadget">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Gadget" active="Daftar Gadget"></x-header>
            <div class="section">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <a href="{{ url('informasi') }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i> kembali </a>
                        <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="bi-plus"></i> Tambah Data </a>
                      </div>
                      <div class="card-body">
                            <div class="row d-flex align-items-stretch">
                                @foreach ($data as $item)
                                @php
                                    $detail = json_decode($item->detail);
                                @endphp
                                    <div class="col-12 col-sm-4 col-md-3 d-flex align-items-stretch">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0 font-weight-bold">
                                        {{ ucwords($item->nama)}}
                                        </div>
                                        <div class="card-body pt-0 pb-0">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                <a href="{{ asset('img/company/informasi/gadget/'.$item->gambar)}}" target="_blank"><img src="{{ asset('img/company/informasi/gadget/'.$item->gambar)}}" alt="logo_merk" class="img-fluid img-rounded"></a>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="text-muted text-sm text-justify">{{ Str::substr($detail->tentang, 0, 100)}}. . . </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-primary p-2">
                                            <div class="text-center">
                                                <form id="data-{{ $item->id }}" action="{{url('/merk',$item->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <a href="{{ url('/informasi/'.$item->id)}}" class="btn btn-sm btn-outline-light">
                                                    <i class="fas fa-list"></i> {{ count($item->informasisub) }}
                                                </a>
                                                    <button type="button" data-toggle="modal"  data-nama="{{ $item->nama }}"  data-tentang="{{ $item->tentang }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-outline-light btn-sm" data-original-title="Edit Task">
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
            <div class="modal fade" id="tambah">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <form action="{{ url('/merk')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Merk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body p-3">
                        <section class="p-3">
                           <div class="form-group row">
                                <label for="" class="col-md-4">Nama Merk</label>
                                <input type="text" name="nama" id="nama" class="form-control col-md-8" value="{{ old('nama')}}" required>
                           </div>
                           <div class="form-group row">
                               <label for="" class="col-md-4">Tentang</label>
                               <input type="text" name="tentang" id="tentang" class="form-control col-md-8"  value="{{ old('tentang')}}" required>
                            </div>
                            <div class="form-group row">
                                 <label for="" class="col-md-4">Logo</label>
                                 <input type="file" name="logo" id="logo" class="form-control col-md-8" required>
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
                    <form action="{{ route('merk.update','test')}}" method="post" enctype="multipart/form-data">
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
                                <label for="" class="col-md-4">Nama Merk</label>
                                <input type="text" name="nama" id="nama" class="form-control col-md-8" value="{{ old('nama')}}" required>
                           </div>
                           <div class="form-group row">
                               <label for="" class="col-md-4">Tentang</label>
                               <input type="text" name="tentang" id="tentang" class="form-control col-md-8"  value="{{ old('tentang')}}" required>
                            </div>
                            <div class="form-group row">
                                 <label for="" class="col-md-4">Logo</label>
                                 <input type="file" name="logo" id="logo" class="form-control col-md-8" required>
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
        </div>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama = button.data('nama')
                var tentang = button.data('tentang')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama').val(nama);
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