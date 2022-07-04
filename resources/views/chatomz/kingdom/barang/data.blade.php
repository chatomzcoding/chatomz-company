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
                    <div class="card-header">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary btn-sm">Tambahkan Data {{ $format }}</a>
                    </div>
                    <div class="card-body">
                        @isset($dataformat->data)
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>Id</th>
                                        @foreach ($dataformat->format as $item)
                                            <th>{{ $item->field }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataformat->data as $id => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <x-aksi :id="$barang->id" :unique="$loop->iteration" link="barang?s=data&format={{ $format }}&id={{ $id }}">
                                                    {{-- <button type="button" data-bs-toggle="modal"  data-field="{{ $item->field }}"  data-tipe="{{ $item->tipe }}" data-id="{{ $id }}" data-bs-target="#ubah" title="" data-original-title="Edit Task" class="dropdown-item text-success">
                                                        <i class="fa fa-edit"></i> EDIT
                                                    </button> --}}
                                                </x-aksi>
                                            </td>
                                            <td>{{ $id }}</td>
                                                @foreach ($dataformat->format as $i)
                                                    @php
                                                        $field = $i->field
                                                    @endphp
                                                    <td>
                                                        @isset($item->$field)
                                                         {{ getdataitem($item->$field,$i->fungsi) }}
                                                        @endisset
                                                    </td>
                                                @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>                                      
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    <x-modalsimpan link="barang" judul="Tambah Data">
        <section>
            <input type="hidden" name="id" value="{{ $barang->id }}">
            <input type="hidden" name="s" value="data">
            <input type="hidden" name="nama_format" value="{{ $format }}">
            @foreach ($dataformat->format as $item)
                <div class="form-group">
                    <label for="">{{ $item->field }}</label>
                    <input type="{{ $item->tipe }}" name="{{ $item->field }}" class="form-control">
                </div>
            @endforeach
        </section>
    </x-modalsimpan>
    </x-slot>
</x-mazer-layout>
