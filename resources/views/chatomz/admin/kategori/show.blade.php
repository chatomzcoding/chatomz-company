<x-mazer-layout title="CHATOMZ - Data Sub Kategori" datatables="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Kategori {{ $kategori->nama_kategori }}" active="Daftar Sub Kategori">
                <li class="breadcrumb-item"><a href="{{ url('kategori?label='.$kategori->label)}}">{{ ucwords($kategori->nama_kategori) }}</a></li>
            </x-header>
            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <x-sistem.kembali url="kategori"></x-sistem>
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Sub Kategori </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="10%">Aksi</th>
                                            <th>Nama Sub Kategori</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        @forelse ($kategori->subkategori as $item)
                                        <tr>
                                                <td class="text-center">{{ $loop->iteration}}</td>
                                                <td class="text-center">
                                                    <x-aksi :id="$item->id" link="subkategori">
                                                        <a href="{{ url('kategori/'.$item->id) }}" class="dropdown-item text-primary"><i class="fas fa-file" style="width: 20px;"></i> DETAIL</a>
                                                        <button type="button" data-bs-toggle="modal"  data-nama_sub="{{ $item->nama_sub }}"  data-keterangan_sub="{{ $item->keterangan_sub }}"  data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                            <i class="fa fa-edit" style="width: 20px;"></i> EDIT
                                                        </button>
                                                    </x-aksi>
                                                </td>
                                                <td>
                                                    {{ $item->nama_sub}}  <br> 
                                                    {{-- @if (!is_null($item->gambar))
                                                        <a href="{{ asset('img/kategori/'.$item->gambar) }}" target="_blank"><img src="{{ asset('img/kategori/'.$item->gambar) }}" alt="" width="150px"></a>
                                                    @endif --}}
                                                </td>
                                                <td>{{ $item->keterangan_sub}}</td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4">tidak ada data</td>
                                            </tr>
                                        @endforelse
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        {{-- modal --}}
        <x-modalsimpan judul="Tambah Kategori" link="subkategori">
            <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
            <section class="p-3">
                <div class="form-group row">
                        <label for="" class="col-md-4">Nama Kategori {!! ireq() !!}</label>
                        <input type="text" name="nama_sub" id="nama_sub" class="form-control col-md-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Keterangan</label>
                    <textarea name="keterangan_sub" id="keterangan_sub" cols="30" rows="3" class="form-control col-md-8"></textarea>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Gambar</label>
                    <input type="file" name="gambar_sub" id="gambar" class="form-control col-md-8">
                </div>
            </section>
        </x-modalsimpan>
        <x-modalubah judul="ubah data kategori" link="subkategori">
            <section class="p-3">
                <div class="form-group row">
                        <label for="" class="col-md-4">Nama Kategori {!! ireq() !!}</label>
                        <input type="text" name="nama_sub" id="nama_sub" class="form-control col-md-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Keterangan</label>
                    <textarea name="keterangan_sub" id="keterangan_sub" cols="30" rows="3" class="form-control col-md-8"></textarea>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Gambar</label>
                    <input type="file" name="gambar_sub" id="gambar" class="form-control col-md-8">
                </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_sub = button.data('nama_sub')
                var keterangan_sub = button.data('keterangan_sub')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #nama_sub').val(nama_sub);
                modal.find('.modal-body #keterangan_sub').val(keterangan_sub);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
