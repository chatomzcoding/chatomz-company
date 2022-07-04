<x-mazer-layout title="CHATOMZ - Detail Barang" alert="TRUE">
    <x-slot name="content">
      <div class="page-heading">
        <x-header head="pengaturan Format" active="Detail"></x-header>
        <div class="section">
          <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body p-2">
                        <x-sistem.kembali url="barang/{{ $barang->id }}"></x-sistem.kembali>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary btn-sm"><i class="bi-plus"></i> Tambah Format</a>
                    </div>
                    <div class="card-body">
                        <section>
                            @if (!is_null($barang->detail))
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Format</th>
                                                <th>Label</th>
                                                <th>Info</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (json_decode($barang->detail) as $namaformat => $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-capitalize">{{ $namaformat }}</td>
                                                    <td>{{ $item->label }}</td>
                                                    <td>{{ $item->info }}</td>
                                                    <td>
                                                        <a href="{{ url('barang/'.$barang->id.'?s=format&format='.$namaformat) }}" class="btn btn-primary btn-sm">Format</a>
                                                        <a href="{{ url('barang/'.$barang->id.'?s=data&format='.$namaformat) }}" class="btn btn-primary btn-sm">Data</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                      
                                </div>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      {{-- modal tambah format --}}
      <x-modalsimpan link="barang" judul="Tambah Format Detail">
        <section>
            <input type="hidden" name="id" value="{{ $barang->id }}">
            <input type="hidden" name="s" value="format">
            <div class="form-group">
                <label for="">Nama Format</label>
                <input type="text" name="nama_format" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Label</label>
                <input type="text" name="label" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Info</label>
                <textarea name="info" class="form-control" cols="12" rows="3" required></textarea>
            </div>
        </section>
      </x-modalsimpan>
    </x-slot>
</x-mazer-layout>
