<x-mazer-layout title="CHATOMZ - Keuangan" menu="keuangan">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Manajemen Keuangan" active="Daftar Manajemen Keuangan"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-2">
                                <x-sistem.kembali url='rekening'></x-sistem.kembali>
                                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus"></i> Kebutuhan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header fw-bold">
                                DAFTAR KEBUTUHAN
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-borderless">
                                        <thead class="text-center">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Aksi</th>
                                                <th>Nama Kebutuhan</th>
                                                <th>Kategori</th>
                                                <th>Waktu</th>
                                                <th>Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-capitalize">
                                            @forelse ($kebutuhan as $item)
                                            <tr>
                                                    <td class="text-center">{{ $loop->iteration}}</td>
                                                    <td class="text-center">
                                                        <x-aksi :id="$item->id" link="manajemenkeuangan">

                                                        </x-aksi>
                                                    </td>
                                                    <td>{{ $item->judul}}</td>
                                                    <td>{{ $item->subkategori->nama_sub}}</td>
                                                    <td>{{ $item->waktu}}</td>
                                                    <td class="text-end">{{ norupiah($item->nominal)}}</td>
                                                </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="6">tidak ada data</td>
                                                </tr>
                                            @endforelse
                                            @if (count($kebutuhan) > 0)
                                                <tr class="table-info">
                                                    <th colspan="5">Jumlah Kebutuhan</th>
                                                    <td class="text-end">{{ norupiah(keuanganTotalManajemen($kebutuhan)) }}</td>
                                                </tr>
                                            @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- MODAL --}}
        <x-modalsimpan judul="Tambah Kebutuhan Baru" link="manajemenkeuangan">
            <input type="hidden" name="alokasi" value="kebutuhan">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Kebutuhan</label>
                    <input type="text" name="judul" id="judul" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="subkategori_id" id="subkategori_id" class="form-control">
                        @foreach ($kategori as $item)
                            @foreach ($item->subkategori as $key)
                            <option value="{{ $key->id }}">{{ strtoupper($item->nama_kategori).' - '.ucwords($key->nama_sub) }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nominal</label>
                    <input type="text" name="nominal" id="rupiah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Waktu</label>
                    <select name="waktu" id="waktu" class="form-control">
                        @foreach (keuanganWaktu() as $item)
                            <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                        @endforeach
                    </select>
                </div>
            </section>
        </x-modalsimpan>
    </x-slot>
</x-mazer-layout>
