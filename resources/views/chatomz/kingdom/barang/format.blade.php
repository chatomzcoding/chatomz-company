<x-mazer-layout title="CHATOMZ - Detail Barang" alert="TRUE">
    <x-slot name="content">
      <div class="page-heading">
        <x-header head="Data Barang {{ $barang->nama_barang.' - '.$format }}" active="Detail"></x-header>
        <div class="section">
          <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body p-2">
                        <x-sistem.kembali url="barang/{{ $barang->id.'?s=detail' }}"></x-sistem.kembali>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>Id</th>
                                        <th>Field</th>
                                        <th>Tipe Data</th>
                                        <th>Fungsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary btn-sm">Tambahkan Format {{ $format }}</a>
                                    @if (!is_null($dataformat->format))
                                        @foreach ($dataformat->format as $id => $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <x-aksi :id="$barang->id" :unique="$loop->iteration" link="barang?s=format&format={{ $format }}&id={{ $id }}">
                                                        <button type="button" data-bs-toggle="modal"  data-field="{{ $item->field }}"  data-tipe="{{ $item->tipe }}" data-id="{{ $id }}" data-bs-target="#ubah" title="" data-original-title="Edit Task" class="dropdown-item text-success">
                                                            <i class="fa fa-edit"></i> EDIT
                                                        </button>
                                                    </x-aksi>
                                                </td>
                                                <td>{{ $id }}</td>
                                                <td>{{ $item->field }}</td>
                                                <td>{{ $item->tipe }}</td>
                                                <td>{{ $item->fungsi }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>                                      
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      {{-- modal tambah format --}}
      <x-modalsimpan link="barang" judul="Tambah Field Format">
        <section>
            <input type="hidden" name="id" value="{{ $barang->id }}">
            <input type="hidden" name="s" value="field">
            <input type="hidden" name="nama_format" value="{{ $format }}">
            <div class="form-group">
                <label for="">Field</label>
                <input type="text" name="field" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Tipe Data</label>
                <input type="text" name="tipe" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Fungsi</label>
                <input type="text" name="fungsi" class="form-control">
            </div>
        </section>
      </x-modalsimpan>
    </x-slot>
</x-mazer-layout>
