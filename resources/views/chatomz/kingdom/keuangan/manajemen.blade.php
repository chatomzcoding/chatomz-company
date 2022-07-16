<x-mazer-layout title="CHATOMZ - Keuangan" menu="keuangan" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Manajemen Keuangan" active="Daftar Manajemen Keuangan"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-2">
                                <x-sistem.kembali url='rekening'></x-sistem.kembali>
                                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus"></i> Manajemen</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header fw-bold">
                                Daftar Manajemen Keuangan
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-borderless">
                                        <thead class="text-center">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Aksi</th>
                                                <th>Alokasi</th>
                                                <th>Nama Kebutuhan</th>
                                                <th>Kategori</th>
                                                <th>Waktu</th>
                                                <th>Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-capitalize">
                                            @forelse ($manajemen as $item)
                                            <tr>
                                                    <td class="text-center">{{ $loop->iteration}}</td>
                                                    <td class="text-center">
                                                        <x-aksi :id="$item->id" link="manajemenkeuangan">
                                                            <button type="button" data-bs-toggle="modal" data-alokasi="{{ $item->alokasi }}" data-judul="{{ $item->judul }}"  data-nominal="{{ $item->nominal }}" data-waktu="{{ $item->waktu }}" data-subkategori_id="{{ $item->subkategori_id }}"  data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                                <i class="bi-pen" style="width: 20px;"></i> EDIT
                                                            </button>
                                                        </x-aksi>
                                                    </td>
                                                    <td>{{ $item->alokasi}}</td>
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header fw-bold">
                                Perencanaan Keuangan <span class="badge bg-info float-end">{{ bulan_indo() }}</span>
                            </div>
                            <div class="card-body">
                               <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tr>
                                            <th colspan="2">Pemasukan</th>
                                            <td class="text-end text-success" width="20%">{{ norupiah($perencanaan['pemasukan']) }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Kewajiban</th>
                                            <td class="text-end text-danger">{{ norupiah($perencanaan['kewajiban']) }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Dana Alokasi</th>
                                            <td class="text-end text-primary">{{ norupiah(keuangan_danaalokasi($perencanaan['pemasukan'],$perencanaan['kewajiban'])) }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="table-info">Alokasi Perencanaan</th>
                                        </tr>
                                        @foreach ($perencanaan['perencanaan']['data'] as $label => $item)
                                            @php
                                                $progress = keuangan_progressperencanaan($perencanaan,$item)
                                            @endphp
                                            <tr>
                                                <td class="ps-4 text-capitalize" width="25%">{{ $label }}</td>
                                                <td>
                                                    <div class="progress progress-primary">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $progress['nilaipersen'] }}%" aria-valuemin="0" aria-valuemax="100">
                                                           <small>{{ $progress['nilaipersen'] }}%</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">{{ keuangan_alokasiterpakai($item['nominal']) }} / {{ norupiah($progress['alokasi']) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th class="ps-4" colspan="2">Total Perencanaan</th>
                                            <td class="text-end">{{ norupiah($perencanaan['perencanaan']['total']) }}</td>
                                        </tr>
                                        <tr class="table-primary">
                                            <th colspan="2">Sisa Dana Alokasi</th>
                                            <th class="text-end h3">{{ norupiah(keuangan_sisadanaalokasi($perencanaan)) }}</th>
                                        </tr>
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
                    <label for="">Alokasi</label>
                    <select name="alokasi" id="alokasi" class="form-control">
                        @foreach (list_manajemenkeuangan() as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nominal</label>
                    <input type="text" name="nominal" id="rupiah" class="form-control" autocomplete="off" required>
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
        <x-modalubah judul="ubah kebutuhan" link="manajemenkeuangan">
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
                    <label for="">Alokasi</label>
                    <select name="alokasi" id="alokasi" class="form-control">
                        @foreach (list_manajemenkeuangan() as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nominal</label>
                    <input type="text" name="nominal" id="rupiah" class="form-control" autocomplete="off" required>
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
        </x-modalubah>
       
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var alokasi = button.data('alokasi')
                var judul = button.data('judul')
                var nominal = button.data('nominal')
                var waktu = button.data('waktu')
                var subkategori_id = button.data('subkategori_id')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #alokasi').val(alokasi);
                modal.find('.modal-body #judul').val(judul);
                modal.find('.modal-body #rupiah').val(nominal);
                modal.find('.modal-body #waktu').val(waktu);
                modal.find('.modal-body #subkategori_id').val(subkategori_id);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
