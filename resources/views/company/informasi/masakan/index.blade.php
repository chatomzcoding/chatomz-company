<x-mazer-layout title="DUNIA MASAKAN" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Masakan" active="Daftar Resep Masakan"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <a href="{{ url('informasi') }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i> Kembali </a>
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi-plus"></i> Tambah Masakan </a>
                            <button data-bs-toggle="modal" data-bs-target="#hapus" class="btn btn-outline-danger btn-sm"><i class="bi-trash"></i> Hapus Semua</button>
                            {{-- @if (isset($_GET['total']))
                                <span class="float-end">Total Pencarian {{ $_GET['total'] }}</span>
                            @endif --}}
                        </header>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($data as $item)
                                <div class="col-12 col-sm-4 col-md-3">
                                <div class="card">
                                    @php
                                        $detail = json_decode($item->detail); 
                                    @endphp
                                    <div class="card-content">
                                        <a href="{{ url('public/img/company/informasi/masakan/'.$item->gambar)}}" target="_blank"><img src="{{ url('public/img/company/informasi/masakan/'.$item->gambar)}}" alt="user-avatar" class="card-img-top img-fluid"></a> <br>
                                    <section class="text-center py-2">
                                        {{ ucwords($item->nama)}} <br>
                                        {{-- @if (isset($detail->Year))
                                            <i>{{ $detail->Year}}</i>
                                        @endif --}}
                                    </section>
                                    </div>
                                    <div class="card-footer bg-primary p-1">
                                    <div class="text-center">
                                        <form id="data-{{ $item->id }}" action="{{url('/informasi',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <a href="{{ url('/informasi/'.$item->id)}}" class="btn btn-sm btn-outline-light">
                                            {{-- <i class="fas fa-list"></i> <span>{{ count($item->informasisub) }}</span> --}} Detail
                                        </a>
                                            {{-- <button type="button" data-bs-toggle="modal"  data-nama="{{ $item->nama }}"  data-nama_latin="{{ $detail->nama_latin }}"  data-tentang="{{ $detail->tentang }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="btn btn-outline-light btn-sm" data-original-title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </button> --}}
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
        <x-modal judul="Hapus Semua Data" id="hapus">
            <section class="text-center">
                <a href="{{ url('informasi?id='.$kategori->id.'&hapus=TRUE') }}" class="btn btn-danger btn-sm">Hapus Semua</a>
            </section>
        </x-modal>
        <x-modalsimpan judul="Tambah Data Resep Masakan" link="informasi">
            <input type="hidden" name="sesi" value="masakan">
            <section class="p-3">
                <div class="form-group">
                     <label for="">Cari Resep Masakan</label>
                     <input type="text" name="cari" id="cari" class="form-control" value="{{ old('cari')}}" required>
                </div>
                {{-- <div class="form-group row">
                     <label for="" class="col-md-4">Page</label>
                     <input type="number" name="page" id="page" class="form-control col-md-8"  value="1">
                </div> --}}
             </section>
        </x-modalsimpan>
        <x-modalubah judul="Ubah Data Informasi Hewan" link="informasi">
            <section class="p-3">
                <input type="hidden" name="sesi" value="hewan">
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
        </x-modalubah>
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