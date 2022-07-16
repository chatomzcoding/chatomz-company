<x-singel-layout title="CHATOMZ - Keuangan" menu="keuangan" back="rekening/{{ $jurnal->rekening_id }}">
    <x-slot name="content">
        <div class="page-heading">
            <h3>Data Jurnal - {{ ucwords($jurnal->nama_jurnal) }}</h3>
            <div class="section">
                <div class="card p-0">
                    <div class="card-body p-2">
                        <a href="#" data-bs-target="#ubahjurnal" data-bs-toggle="modal" class="btn btn-outline-success btn-sm"><i class="bi-pen"></i></a>
                        @if (isset($jurnal->jurnalmanajemen))
                            <button class="btn btn-primary btn-sm text-capitalize" data-bs-toggle="modal" data-bs-target="#ubahjurnalmanajemen">{{ $jurnal->jurnalmanajemen->manajemenkeuangan->alokasi }} - {{ $jurnal->jurnalmanajemen->manajemenkeuangan->judul.' | '.rupiah($jurnal->jurnalmanajemen->nominal) }}</button>
                        @else
                            <a href="#" data-bs-target="#jurnalmanajemen" data-bs-toggle="modal" class="btn btn-outline-info btn-sm"><i class="bi-plus"></i> Perencanaan</a>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                               <table class="table table-borderless">
                                    <tr>
                                        <th>Total Belanja</th>
                                        <td class="text-end">{{ norupiah($jurnal->nominal) }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th>Total Item</th>
                                        <td class="text-end">{{ norupiah($main['totalharga']) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Belum terdata</th>
                                        <td class="text-end">{{ norupiah($main['sisa']) }}</td>
                                    </tr>
                               </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <section class="mb-3">
                                    <x-sistem.tambah></x-sistem.tambah>
                                    <x-sistem.tambah id="tambahitem">Item</x-sistem.tambah>
                                </section>
                                <p>Daftar Item Jurnal</p>
                                <div class="table-responsive">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr class="small">
                                                <th width="10%" class="text-center">Aksi</th>
                                                <th>Item</th>
                                                <th>Jumlah</th>
                                                <th class="text-end">Harga</th>
                                                <th class="text-end">Diskon</th>
                                                <th class="text-end">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-capitalize">
                                            @forelse ($jurnal->jurnalitem as $item)
                                            <tr class="small">
                                                <td class="text-center">
                                                    <x-aksi link="jurnalitem" :id="$item->id">
                                                        <button type="button" data-bs-toggle="modal"  data-harga="{{ $item->harga }}" data-detail="{{ $item->detail }}"  data-jumlah="{{ $item->jumlah }}" data-diskon="{{ $item->diskon }}" data-satuan="{{ $item->satuan }}" data-item_id="{{ $item->item_id }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                            <i class="bi-pen" style="width: 20px;"></i> EDIT
                                                        </button>
                                                    </x-aksi>
                                                </td>
                                                <td>
                                                    <a href="{{ url('item/'.$item->item_id) }}">{{ $item->item->nama_item}}</a> <br>
                                                    <i>{{ $item->detail}}</i>
                                                </td>
                                                    <td>{{ $item->jumlah.' '.$item->satuan}}</td>
                                                    <td class="text-end">{{ norupiah($item->harga)}}</td>
                                                    <td class="text-end">{{ norupiah($item->diskon)}}</td>
                                                    <td class="text-end">{{ norupiah(subtotal($item->jumlah,$item->harga,$item->diskon))}}</td>
                                                </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="5">tidak ada data</td>
                                                </tr>
                                            @endforelse
                                            <tr class="text-primary">
                                                <th colspan="5">Jumlah Total</th>
                                                <th class="text-end">{{ norupiah($main['totalharga']) }}</th>
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
        <x-modalsimpan judul="Tambah Item" link="item" id="tambahitem" tabindex="">
            <section class="p-3">
                <div class="form-group">
                        <label for="">Nama Item {!! ireq() !!}</label>
                        <input type="text" name="nama_item" id="nama_item" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Kelompok {!! ireq() !!}</label>
                    <select name="kelompok" id="" class="form-select select2bs4">
                        @foreach ($kelompok as $item)
                            <option value="{{ $item->nama_kategori }}">{{ strtoupper($item->nama_kategori) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Gambar</label>
                    <input type="file" name="gambar_item" id="gambar" class="form-control">
                </div>
            </section>
        </x-modalsimpan>
        <x-modalsimpan judul="Tambah Item" link="jurnalitem" tabindex="">
            <input type="hidden" name="jurnal_id" value="{{ $jurnal->id }}">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Item</label>
                    <select name="item_id" class="form-select select2bs4">
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ ucwords($item->nama_item) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" name="harga" id="rupiah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Diskon</label>
                    <input type="text" name="diskon" id="rupiah3" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="number" name="jumlah" value="1" class="form-control" step="any" required>
                </div>
                <div class="form-group">
                    <label for="">Satuan</label>
                    <select name="satuan" class="form-select select2bs4">
                        @foreach ($satuan as $item)
                            <option value="{{ $item->nama_kategori }}">{{ ucwords($item->nama_kategori) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Detail</label>
                    <input type="text" name="detail" id="detail" class="form-control">
                </div>
            </section>
        </x-modalsimpan>
        <x-modalubah judul="Ubah Item" link="jurnalitem" tabindex="">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Item</label>
                    <select name="item_id" id="item_id" class="form-select select2bs4" data-width="100%">
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ ucwords($item->nama_item) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" name="harga" id="rupiah1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Diskon</label>
                    <input type="text" name="diskon" id="rupiah4" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" step="any" required>
                </div>
                <div class="form-group">
                    <label for="">Satuan</label>
                    <select name="satuan" id="satuan" class="form-select select2bs4">
                        @foreach ($satuan as $item)
                            <option value="{{ $item->nama_kategori }}">{{ ucwords($item->nama_kategori) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Detail</label>
                    <input type="text" name="detail" id="detail" class="form-control">
                </div>
            </section>
        </x-modalubah>
        <x-modalubah judul="Ubah Jurnal" id="ubahjurnal" link="jurnal">
            <input type="hidden" name="id" value="{{ $jurnal->id }}">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Jurnal</label>
                    <input type="text" name="nama_jurnal" value="{{ $jurnal->nama_jurnal }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Nominal</label>
                    <input type="text" name="nominal" id="rupiah2" value="{{ $jurnal->nominal }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="subkategori_id" id="subkategori_id" class="form-control">
                        @foreach ($kategori as $item)
                            @foreach ($item->subkategori as $key)
                            <option value="{{ $key->id }}" @if ($jurnal->subkategori_id == $key->id)
                                selected
                            @endif>{{ strtoupper($item->nama_kategori).' - '.ucwords($key->nama_sub) }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Arus Jurnal</label>
                    <select name="arus" id="arus" class="form-control">
                        <option value="pemasukan" @if ($jurnal->arus == 'pemasukan')
                            selected
                        @endif>PEMASUKAN</option>
                        <option value="pengeluaran" @if ($jurnal->arus == 'pengeluaran')
                            selected
                        @endif>PENGELUARAN</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi Jurnal</label>
                    <input type="text" name="deskripsi" id="deskripsi" value="{{ $jurnal->deskripsi }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Jurnal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ $jurnal->tanggal }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Jam Jurnal</label>
                    <input type="time" name="jam" value="{{ $jurnal->jam }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Garansi</label>
                    <input type="date" name="garansi" id="garansi" value="{{ $jurnal->garansi }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tempat</label>
                    <input type="text" name="tempat" id="tempat" value="{{ $jurnal->tempat }}" class="form-control">
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
        <x-modalsimpan id="jurnalmanajemen" judul="Tambah Manajemen Keuangan" link="jurnalmanajemen">
            <input type="hidden" name="jurnal_id" value="{{ $jurnal->id }}">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Manajemen Keuangan</label>
                    <select name="manajemenkeuangan_id" id="manajemenkeuangan_id" class="form-control">
                        @foreach ($manajemen as $item)
                            <option value="{{ $item->id }}">{{ $item->judul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nominal</label>
                    <input type="text" name="nominal" value="{{ $jurnal->nominal }}" class="form-control" required>
                </div>
            </section>
        </x-modalsimpan>
        @if (isset($jurnal->jurnalmanajemen))
            <x-modalubah id="ubahjurnalmanajemen" judul="Ubah Jurnal Manajemen Keuangan" link="jurnalmanajemen">
                <input type="hidden" name="id" value="{{ $jurnal->jurnalmanajemen->id }}">
                <section class="p-3">
                    <div class="form-group">
                        <label for="">Manajemen Keuangan</label>
                        <select name="manajemenkeuangan_id" id="manajemenkeuangan_id" class="form-control">
                            @foreach ($manajemen as $item)
                                <option value="{{ $item->id }}" @if ($jurnal->jurnalmanajemen->manajemenkeuangan_id == $item->id)
                                    selected
                                @endif>{{ $item->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nominal</label>
                        <input type="text" name="nominal" value="{{ $jurnal->jurnalmanajemen->nominal }}" class="form-control" required>
                    </div>
                </section>
            </x-modalubah>
        @endif
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var item_id = button.data('item_id')
                var harga = button.data('harga')
                var diskon = button.data('diskon')
                var detail = button.data('detail')
                var satuan = button.data('satuan')
                var jumlah = button.data('jumlah')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #item_id').val(item_id);
                modal.find('.modal-body #rupiah1').val(harga);
                modal.find('.modal-body #rupiah4').val(diskon);
                modal.find('.modal-body #detail').val(detail);
                modal.find('.modal-body #satuan').val(satuan);
                modal.find('.modal-body #jumlah').val(jumlah);
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
