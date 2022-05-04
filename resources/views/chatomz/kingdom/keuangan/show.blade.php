<x-singel-layout title="CHATOMZ - Keuangan" menu="keuangan" back="rekening">
    <x-slot name="content">
        <div class="page-heading">
            <h3>Data Rekening - {{ ucwords($rekening->nama_rekening) }}</h3>
            <div class="section">
                <div class="row">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-body p-2">
                                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus-circle-fill"></i> Tambah Jurnal </a>
                                <a href="#" class="btn btn-outline-success btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#editrekening"><i class="bi bi-pen"></i> Edit Dompet </a>
                              </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card">
                            <div class="card-body p-2 pb-0 text-end">
                                <h3>{{ norupiah($main['total']['total']) }}</h3>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-primary">Pemasukan <span class="float-end">{{ norupiah($perhitungan['pemasukan']) }}</span></p>
                                <p class="text-danger">Pengeluaran <span class="float-end">{{ norupiah($perhitungan['pengeluaran']) }}</span></p>
                                <p class="text-info">Arus Kas <span class="float-end">{{ norupiah($perhitungan['hitung']) }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body p-2">
                                <form action="{{ url('rekening/'.$rekening->id) }}" method="get">
                                    <div class="row mb-2">
                                        <div class="col-md-3">
                                            <select name="bulan" id="" class="form-control" onchange="this.form.submit()">
                                                <option value="semua" {{ Syselected('semua',$bulan) }}>SEMUA</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ Syselected($i,$bulan) }}>{{ bulan_indo($i) }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                    <table id="example1" class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">No</th>
                                                <th width="10%" class="text-center">Aksi</th>
                                                <th>Tanggal</th>
                                                <th>Nama Jurnal</th>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-capitalize">
                                            @forelse ($jurnal as $item)
                                            <tr class="text-{{ keuanganWarnaArus($item->arus) }}">
                                                    <td class="text-center">{{ $loop->iteration}}</td>
                                                    <td class="text-center">
                                                        <x-aksi link="jurnal" :id="$item->id">
                                                            <button type="button" data-bs-toggle="modal"  data-nama_jurnal="{{ $item->nama_jurnal }}"  data-nominal="{{ $item->nominal }}" data-tanggal="{{ $item->tanggal }}" data-arus="{{ $item->arus }}" data-subkategori_id="{{ $item->subkategori_id }}" data-deskripsi="{{ $item->deskripsi }}"  data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                                <i class="bi-pen" style="width: 20px;"></i> EDIT
                                                            </button>
                                                        </x-aksi>
                                                    </td>
                                                    <td>{{ date_indo($item->tanggal)}}</td>
                                                    <td>{{ $item->nama_jurnal}}</td>
                                                    <td>{{ $item->subkategori->nama_sub}}</td>
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
        </div>
        {{-- MODAL --}}
        <x-modalsimpan judul="Tambah Jurnal Baru" link="jurnal">
            <input type="hidden" name="rekening_id" value="{{ $rekening->id }}">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Jurnal</label>
                    <input type="text" name="nama_jurnal" id="nama_jurnal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Nominal</label>
                    <input type="text" name="nominal" id="rupiah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="subkategori_id" id="subkategori_id" class="form-control">
                        @foreach ($kategori as $item)
                            @foreach ($item->subkategori as $key)
                            <option value="{{ $key->id }}">{{ strtoupper($item->nama_jurnal).' - '.ucwords($key->nama_sub) }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Arus Jurnal</label>
                    <select name="arus" id="arus" class="form-control">
                        <option value="pemasukan">PEMASUKAN</option>
                        <option value="pengeluaran">PENGELUARAN</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="selesai">SELESAI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi Jurnal</label>
                    <input type="text" name="deskripsi" id="deskripsi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Jurnal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Jam Jurnal</label>
                    <input type="time" name="jam" id="jam" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Garansi</label>
                    <input type="date" name="garansi" id="garansi" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tempat</label>
                    <input type="text" name="tempat" id="tempat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Label</label>
                    <input type="text" name="label" id="label" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Struk</label>
                    <input type="file" name="struk" id="struk" class="form-control">
                </div>
            </section>
        </x-modalsimpan>
        <x-modalubah judul="Ubah Rekening" link="rekening" id="editrekening">
            <input type="hidden" name="id" value="{{ $rekening->id }}">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Rekening</label>
                    <input type="text" name="nama_rekening" value="{{ $rekening->nama_rekening }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Saldo Awal</label>
                    <input type="text" name="saldo_awal" id="rupiah2"  value="{{ $rekening->saldo_awal }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Jenis Rekening</label>
                    <select name="jenis" id="jenis" class="form-control">
                        <option value="cash" {{ SySelected('cash',$rekening->jenis) }}>CASH</option>
                        <option value="bank" {{ SySelected('bank',$rekening->jenis) }}>BANK</option>
                        <option value="e-money" {{ SySelected('e-money',$rekening->jenis) }}>E-MONEY</option>
                    </select>
                </div>
                @php
                    $detail = json_decode($rekening->detail)
                @endphp
                <div class="form-group">
                    <label for="">Tentang Rekening</label>
                    <input type="text" name="tentang" id="tentang" value="{{ $detail->tentang }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Icon Rekening</label>
                    <input type="text" name="icon" id="icon" value="{{ $detail->icon }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Warna</label>
                    <input type="text" name="warna" id="warna" value="{{ $detail->warna }}" class="form-control" required>
                </div>
            </section>
        </x-modalubah>
        <x-modalubah judul="Ubah Jurnal" link="jurnal">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Jurnal</label>
                    <input type="text" name="nama_jurnal" id="nama_jurnal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Nominal</label>
                    <input type="text" name="nominal" id="rupiah1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="subkategori_id" id="subkategori_id" class="form-control">
                        @foreach ($kategori as $item)
                            @foreach ($item->subkategori as $key)
                            <option value="{{ $key->id }}">{{ strtoupper($item->nama_jurnal).' - '.ucwords($key->nama_sub) }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Arus Jurnal</label>
                    <select name="arus" id="arus" class="form-control">
                        <option value="pemasukan">PEMASUKAN</option>
                        <option value="pengeluaran">PENGELUARAN</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi Jurnal</label>
                    <input type="text" name="deskripsi" id="deskripsi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Jurnal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Jam Jurnal</label>
                    <input type="time" name="jam" id="jam" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Garansi</label>
                    <input type="date" name="garansi" id="garansi" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tempat</label>
                    <input type="text" name="tempat" id="tempat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Label</label>
                    <input type="text" name="label" id="label" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Struk</label>
                    <input type="file" name="struk" id="struk" class="form-control">
                </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_jurnal = button.data('nama_jurnal')
                var nominal = button.data('nominal')
                var tanggal = button.data('tanggal')
                var subkategori_id = button.data('subkategori_id')
                var arus = button.data('arus')
                var deskripsi = button.data('deskripsi')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #nama_jurnal').val(nama_jurnal);
                modal.find('.modal-body #rupiah1').val(nominal);
                modal.find('.modal-body #tanggal').val(tanggal);
                modal.find('.modal-body #subkategori_id').val(subkategori_id);
                modal.find('.modal-body #arus').val(arus);
                modal.find('.modal-body #deskripsi').val(deskripsi);
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
</x-singel-layout>
