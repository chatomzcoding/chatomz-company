<x-mazer-layout title="CHATOMZ - Data Menu" datatables="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Menu" active="Daftar Menu">
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
                                            <th>Nama Menu</th>
                                            <th>Link</th>
                                            <th>Icon</th>
                                            <th>Urutan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($menu as $item)
                                        <tr>
                                                <td class="text-center">{{ $loop->iteration}}</td>
                                                <td class="text-center">
                                                    <x-aksi :id="$item->id" link="menu">
                                                        <a href="{{ url('menu/'.$item->id) }}" class="dropdown-item text-primary"><i class="fas fa-file" style="width: 20px;"></i> Sub Menu</a>
                                                        <button type="button" data-bs-toggle="modal"  data-nama="{{ $item->nama }}"  data-link="{{ $item->link }}"  data-icon="{{ $item->icon }}" data-urutan="{{ $item->urutan }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                            <i class="fa fa-edit" style="width: 20px;"></i> EDIT
                                                        </button>
                                                    </x-aksi>
                                                </td>
                                                <td>{{ $item->nama}}</td>
                                                <td>{{ $item->link}}</td>
                                                <td><i class="{{ $item->icon}}"></i> </td>
                                                <td class="text-center">{{ $item->urutan}}</td>
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
        <x-modalsimpan judul="Tambah Menu" link="menu">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Menu</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Menu" required>
                </div>
                <div class="form-group">
                    <label for="">link</label>
                    <input type="text" name="link" id="link" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Icon</label>
                    <input type="text" name="icon" id="icon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Urutan</label>
                    <input type="number" name="urutan" id="urutan" class="form-control" required>
                </div>
            </section>
        </x-modalsimpan>
        <x-modalubah judul="ubah data Menu" link="menu">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Menu</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Menu" required>
                </div>
                <div class="form-group">
                    <label for="">link</label>
                    <input type="text" name="link" id="link" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Icon</label>
                    <input type="text" name="icon" id="icon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Urutan</label>
                    <input type="number" name="urutan" id="urutan" class="form-control" required>
                </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama = button.data('nama')
                var link = button.data('link')
                var icon = button.data('icon')
                var urutan = button.data('urutan')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #link').val(link);
                modal.find('.modal-body #icon').val(icon);
                modal.find('.modal-body #urutan').val(urutan);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
