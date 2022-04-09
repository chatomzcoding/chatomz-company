<x-mazer-layout title="Daftar Hewan">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Hewan Jenis {{$informasi->nama }}" active="Jenis-Jenis {{ $informasi->nama }}">
                <li class="breadcrumb-item"><a href="{{ url('hewan')}}">Daftar Hewan</a></li>
            </x-header>
        </div>
        <div class="section">
            <header class="bg-white p-2 rounded mb-2">
                <a href="{{ url('informasi?k='.Crypt::encrypt($informasi->kategori_id)) }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-angle-left"></i> Kembali </a>
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Jenis </a>
                <span class="float-end font-italic">{{ count($informasi->informasisub)}} jenis {{ $informasi->nama}}</span>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($informasi->informasisub as $item)
                            <div class="col-12 col-sm-4 col-md-4">
                                <div class="card">
                                    <div class="card-content">
                                                <a href="{{ asset('img/company/informasi/hewan/'.$item->gambar_sub)}}" target="_blank"><img src="{{ asset('img/company/informasi/hewan/'.$item->gambar_sub)}}" alt="user-avatar" class="card-img-top img-fluid"></a>
                                                <strong>
                                                    {{ ucwords($item->nama_sub)}}
                                                    @php
                                                        $detail = json_decode($item->detail_sub);
                                                    @endphp 
                                                    @if (!is_null($detail->nama_latin))
                                                        <i>({{ $detail->nama_latin}})</i>
                                                    @endif
                                                </strong>
                                            {{-- <p class="text-muted text-sm text-justify">{{ Str::substr($detail->tentang, 0, 130)}}. . . </p>     --}}
                                            <p class="text-muted text-sm text-justify small">{{ $detail->tentang }}</p>    
                                    </div>
                                    <div class="card-footer p-0">
                                            <ul class="list-group list-group-horizontal text-center p-0 rounded-0">
                                            <li class="list-group-item w-100 p-1 rounded-0"><i class="fas fa-utensils text-success"></i> <br> <span class="text-secondary small"> {{ $detail->pemakan }}</span></li>
                                            <li class="list-group-item w-100 p-1 rounded-0"><i class="fas fa-bezier-curve text-primary"></i> <br> <span class="text-secondary small"> {{ $detail->klasifikasi }}</span></li>
                                            <li class="list-group-item w-100 p-1 rounded-0"><i class="fas fa-heartbeat text-danger"></i> <br> 
                                                @if (!empty($detail->lama_hidup))
                                                    <span class="text-secondary small">{{ $detail->lama_hidup }}</span>
                                                @else
                                                    <span class="text-secondary small">-</span>
                                                @endif
                                            </li>
                                        </ul>
                                        <div class="text-right bg-secondary p-1 rounded-bottom">
                                            <form id="data-{{ $item->id }}" action="{{url('/informasisub',$item->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                                <button type="button" data-bs-toggle="modal"  data-nama_sub="{{ $item->nama_sub }}"  data-nama_latin="{{ $detail->nama_latin }}"  data-tentang="{{ $detail->tentang }}" data-pemakan="{{ $detail->pemakan }}" data-klasifikasi="{{ $detail->klasifikasi }}" data-lama_hidup="{{ $detail->lama_hidup }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="btn btn-outline-light btn-sm" data-original-title="Edit Task">
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
        <x-modalsimpan judul="tambah jenis hewan" link="informasisub">
            <input type="hidden" name="sesi" value="hewan">
            <input type="hidden" name="informasi_id" value="{{ $informasi->id }}">
            <section class="p-3">
               <div class="form-group">
                    <label for="">Nama Hewan</label>
                    <input type="text" name="nama_sub" id="nama_sub" class="form-control" value="{{ old('nama_sub')}}" required>
               </div>
               <div class="form-group">
                    <label for="">Nama Latin</label>
                    <input type="text" name="nama_latin" id="nama_latin" class="form-control"  value="{{ old('nama_latin')}}">
               </div>
               <div class="form-group">
                    <label for="">Lama Hidup</label>
                    <input type="text" name="lama_hidup" id="lama_hidup" class="form-control"  value="{{ old('lama_hidup')}}">
               </div>
               <div class="form-group">
                    <label for="">Jenis Pemakan</label>
                    <select name="pemakan" id="pemakan" class="form-control">
                        @foreach (list_hewanpemakan() as $item => $isi)
                            <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                        @endforeach
                    </select>
               </div>
               <div class="form-group">
                    <label for="">Klasifikasi Hewan</label>
                    <select name="klasifikasi" id="klasifikasi" class="form-control">
                        @foreach (list_klasifikasihewan() as $item => $isi)
                            <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                        @endforeach
                    </select>
               </div>
               <div class="form-group">
                   <label for="">Tentang</label>
                   <input type="text" name="tentang" id="tentang" class="form-control"  value="{{ old('tentang')}}" required>
                </div>
                <div class="form-group">
                     <label for="">Gambar</label>
                     <input type="file" name="gambar_sub" id="gambar_sub" class="form-control" required>
                </div>
            </section>

        </x-modalsimpan>
        <x-modalubah judul="Ubah Jenis Hewan" link="informasisub">
            <input type="hidden" name="sesi" value="hewan">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Hewan</label>
                    <input type="text" name="nama_sub" id="nama_sub" class="form-control" value="{{ old('nama_sub')}}" required>
               </div>
               <div class="form-group">
                    <label for="">Nama Latin</label>
                    <input type="text" name="nama_latin" id="nama_latin" class="form-control"  value="{{ old('nama_latin')}}">
               </div>
               <div class="form-group">
                    <label for="">Lama Hidup</label>
                    <input type="text" name="lama_hidup" id="lama_hidup" class="form-control"  value="{{ old('lama_hidup')}}">
               </div>
               <div class="form-group">
                    <label for="">Jenis Pemakan</label>
                    <select name="pemakan" id="pemakan" class="form-control">
                        @foreach (list_hewanpemakan() as $item => $isi)
                            <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                        @endforeach
                    </select>
               </div>
               <div class="form-group">
                    <label for="">Klasifikasi Hewan</label>
                    <select name="klasifikasi" id="klasifikasi" class="form-control">
                        @foreach (list_klasifikasihewan() as $item => $isi)
                            <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                        @endforeach
                    </select>
               </div>
               <div class="form-group">
                   <label for="">Tentang</label>
                   <input type="text" name="tentang" id="tentang" class="form-control"  value="{{ old('tentang')}}" required>
                </div>
                <div class="form-group">
                     <label for="">Gambar</label>
                     <input type="file" name="gambar_sub" id="gambar_sub" class="form-control">
                </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_sub = button.data('nama_sub')
                var nama_latin = button.data('nama_latin')
                var tentang = button.data('tentang')
                var pemakan = button.data('pemakan')
                var lama_hidup = button.data('lama_hidup')
                var klasifikasi = button.data('klasifikasi')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_sub').val(nama_sub);
                modal.find('.modal-body #nama_latin').val(nama_latin);
                modal.find('.modal-body #tentang').val(tentang);
                modal.find('.modal-body #pemakan').val(pemakan);
                modal.find('.modal-body #lama_hidup').val(lama_hidup);
                modal.find('.modal-body #klasifikasi').val(klasifikasi);
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
