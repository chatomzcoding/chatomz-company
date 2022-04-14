<x-mazer-layout title="Company - Gadget Handphone" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Gadget" active="Daftar Informasi Gadget"></x-header>
            <div class="section">
                <div class="row">
                  <div class="col-md-12">
                        <header class="p-2 mb-2">
                            <a href="{{ url('informasi?id='.$informasi->kategori_id) }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i> Kembali </a>
                            <a href="{{ url('gadgethandphone/create') }}" class="btn btn-outline-primary btn-flat btn-sm"><i class="bi-plus"></i> Tambah Data </a>
                        </header>
                        <div class="row d-flex align-items-stretch">
                            @foreach ($informasi->informasisub as $item)
                            <div class="col-12 col-sm-2 col-lg-3 col-md-6 d-flex align-items-stretch">
                                <div class="card">
                                    <div class="card-content pt-0 px-0 pb-0">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <a href="{{ url('gadgethandphone/'.Crypt::encryptString($item->id))}}"><img src="{{ asset('img/company/informasi/gadget/'.$item->gambar_sub)}}" alt="gambar gadget" class="img-fluid rounded-top"></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 px-2 pt-2 pb-0">
                                                @php
                                                    $detail     = json_decode($item->detail_sub);
                                                @endphp
                                                <div class="p-2 text-center">
                                                    <strong>
                                                        {{ ucwords($item->nama_sub)}}
                                                    </strong>
                                                <p class="text-muted text-sm text-justify">{{ Str::substr($detail->tentang, 0, 100)}}. . . </p>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-0">
                                        <div class="text-center bg-secondary p-1 rounded-bottom">
                                            <form id="data-{{ $item->id }}" action="{{url('/informasisub',$item->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                                <a href="{{ url('informasisub/'.Crypt::encrypt($item->id).'/edit') }}" class="btn btn-outline-light btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
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
