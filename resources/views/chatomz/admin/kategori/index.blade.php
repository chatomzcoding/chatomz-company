<x-mazer-layout title="CHATOMZ - Data Kategori" datatables="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Kategori" active="Daftar Kategori">
            </x-header>
            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Kategori </a>
                        </div>
                        <div class="card-body">
                            <form action="" method="get">
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="label" id="label" class="form-control" onchange="this.form.submit()">
                                                <option value="semua">-- pilih label --</option>
                                                @foreach ($dlabel as $item)
                                                    <option value="{{ $item->nama_kategori }}" @if ($main['filter']['label'] == $item->nama_kategori)
                                                        selected
                                                    @endif>{{ strtoupper($item->nama_kategori) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                            </form>  
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="10%">Aksi</th>
                                            <th>Label</th>
                                            <th>Nama Kategori</th>
                                            <th>List Tag</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        @forelse ($kategori as $item)
                                        <tr>
                                                <td class="text-center">{{ $loop->iteration}}</td>
                                                <td class="text-center">
                                                    <x-aksi :id="$item->id" link="kategori">
                                                        <button type="button" data-bs-toggle="modal"  data-nama_kategori="{{ $item->nama_kategori }}"  data-keterangan_kategori="{{ $item->keterangan_kategori }}"  data-label="{{ $item->label }}" data-list_tag="{{ $item->list_tag }}"  data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                            <i class="fa fa-edit" style="width: 20px;"></i> EDIT
                                                        </button>
                                                    </x-aksi>
                                                </td>
                                                <td class="text-uppercase">{{ $item->label}}</td>
                                                <td>
                                                    {{ $item->nama_kategori}}  <br> 
                                                    @if (!is_null($item->gambar))
                                                        <a href="{{ asset('img/kategori/'.$item->gambar) }}" target="_blank"><img src="{{ asset('img/kategori/'.$item->gambar) }}" alt="" width="150px"></a>
                                                    @endif
                                                </td>
                                                <td>{{ $item->list_tag}}</td>
                                                <td>{{ $item->keterangan_kategori}}</td>
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
        <x-modalsimpan judul="Tambah Kategori" link="kategori">
            <section class="p-3">
                <div class="form-group row">
                        <label for="" class="col-md-4">Nama Kategori {!! ireq() !!}</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control col-md-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Label {!! ireq() !!}</label>
                    <select name="label" id="label" class="form-control col-md-8" required>
                        @foreach ($dlabel as $item)
                            <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Keterangan {!! ireq() !!}</label>
                    <textarea name="keterangan_kategori" id="keterangan_kategori" cols="30" rows="3" class="form-control col-md-8" required></textarea>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">List Tag</label>
                    <textarea name="list_tag" id="list_tag" cols="30" rows="3" class="form-control col-md-8"></textarea>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control col-md-8">
                </div>
                </section>
        </x-modalsimpan>
        <x-modalubah judul="ubah data kategori" link="kategori">
            <section class="p-3">
                <div class="form-group row">
                    <label for="" class="col-md-4">Nama Kategori {!! ireq() !!}</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control col-md-8" required>
            </div>
            <div class="form-group row">
                <label for="" class="col-md-4">Label {!! ireq() !!}</label>
                <select name="label" id="label" class="form-control col-md-8" required>
                    @foreach ($dlabel as $item)
                        <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
                </div>
            <div class="form-group row">
                <label for="" class="col-md-4">Keterangan {!! ireq() !!}</label>
                <textarea name="keterangan_kategori" id="keterangan_kategori" cols="30" rows="3" class="form-control col-md-8" required></textarea>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">List Tag</label>
                    <textarea name="list_tag" id="list_tag" cols="30" rows="3" class="form-control col-md-8"></textarea>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Gambar (opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control col-md-8">
            </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_kategori = button.data('nama_kategori')
                var label = button.data('label')
                var keterangan_kategori = button.data('keterangan_kategori')
                var list_tag = button.data('list_tag')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #nama_kategori').val(nama_kategori);
                modal.find('.modal-body #label').val(label);
                modal.find('.modal-body #keterangan_kategori').val(keterangan_kategori);
                modal.find('.modal-body #list_tag').val(list_tag);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
