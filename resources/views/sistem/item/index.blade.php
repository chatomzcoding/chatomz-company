<x-mazer-layout title="CHATOMZ - Data Item" datatables="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Item" active="Daftar Item">
            </x-header>
            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <x-sistem.tambah></x-sistem.tambah>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-borderless table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="10%">Aksi</th>
                                                <th>Gambar Item</th>
                                                <th>Nama Item</th>
                                                <th>Keterangan</th>
                                                <th>Kelompok</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-capitalize">
                                            @forelse ($item as $item)
                                            <tr>
                                                    <td class="text-center">{{ $loop->iteration}}</td>
                                                    <td class="text-center">
                                                        <x-aksi :id="$item->id" link="item">
                                                            <button type="button" data-bs-toggle="modal"  data-nama_item="{{ $item->nama_item }}"  data-keterangan="{{ $item->keterangan }}" data-kelompok="{{ $item->kelompok }}"  data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                                <i class="fa fa-edit" style="width: 20px;"></i> EDIT
                                                            </button>
                                                        </x-aksi>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        {{ $item->nama_item}}
                                                    </td>
                                                    <td>{{ $item->keterangan}}</td>
                                                    <td>{{ $item->kelompok}}</td>
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
                </div>
            </section>
        </div>
        {{-- modal --}}
        <x-modalsimpan judul="Tambah Item" link="item">
            <section class="p-3">
                <div class="form-group row">
                        <label for="" class="col-md-4">Nama Item {!! ireq() !!}</label>
                        <input type="text" name="nama_item" id="nama_item" class="form-control col-md-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Kelompok {!! ireq() !!}</label>
                    <select name="kelompok" id="" class="form-control">
                        @foreach ($kelompok as $item)
                            <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control col-md-8"></textarea>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Gambar</label>
                    <input type="file" name="gambar_item" id="gambar" class="form-control col-md-8">
                </div>
            </section>
        </x-modalsimpan>
        <x-modalubah judul="ubah data Item" link="item">
            <section class="p-3">
                <div class="form-group row">
                    <label for="" class="col-md-4">Nama Item {!! ireq() !!}</label>
                    <input type="text" name="nama_item" id="nama_item" class="form-control col-md-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Kelompok {!! ireq() !!}</label>
                    <select name="kelompok" id="" class="form-control">
                        @foreach ($kelompok as $item)
                            <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control col-md-8"></textarea>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Gambar</label>
                    <input type="file" name="gambar_item" id="gambar" class="form-control col-md-8">
                </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_item = button.data('nama_item')
                var keterangan = button.data('keterangan')
                var kelompok = button.data('kelompok')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #nama_item').val(nama_item);
                modal.find('.modal-body #keterangan').val(keterangan);
                modal.find('.modal-body #kelompok').val(kelompok);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
