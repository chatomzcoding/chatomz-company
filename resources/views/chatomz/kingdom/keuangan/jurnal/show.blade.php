<x-singel-layout title="CHATOMZ - Keuangan" menu="keuangan" back="rekening/{{ $jurnal->rekening_id }}">
    <x-slot name="content">
        <div class="page-heading">
            <h3>Data Jurnal - {{ ucwords($jurnal->nama_jurnal) }}</h3>
            <div class="section">
                <div class="card p-0">
                    <div class="card-body p-2">
                        <a href="#" data-bs-target="#ubahjurnal" data-bs-toggle="modal" class="btn btn-outline-success btn-sm"><i class="bi-pen"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                               <table class="table table-borderless">
                                    <tr>
                                        <th>Total Belanja</th>
                                        <td>{{ norupiah($jurnal->nominal) }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th>Total Item</th>
                                        <td>{{ norupiah($main['totalharga']) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Belum terdata</th>
                                        <td>{{ norupiah($main['sisa']) }}</td>
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
                                </section>
                                <p>Daftar Item Jurnal</p>
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">No</th>
                                                <th width="10%" class="text-center">Aksi</th>
                                                <th>Nama Item</th>
                                                <th>Detail</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-capitalize">
                                            @forelse ($jurnal->jurnalitem as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration}}</td>
                                                <td class="text-center">
                                                    <x-aksi link="jurnalitem" :id="$item->id">
                                                        <button type="button" data-bs-toggle="modal"  data-harga="{{ $item->harga }}" data-detail="{{ $item->detail }}" data-item_id="{{ $item->item_id }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                            <i class="bi-pen" style="width: 20px;"></i> EDIT
                                                        </button>
                                                    </x-aksi>
                                                </td>
                                                <td>{{ $item->item->nama_item}}</td>
                                                <td>{{ $item->detail}}</td>
                                                <td class="text-end">{{ norupiah($item->harga)}}</td>
                                            </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="5">tidak ada data</td>
                                                </tr>
                                            @endforelse
                                                <tr class="text-primary">
                                                    <th colspan="4">Jumlah Total</th>
                                                    <th class="text-end">{{ norupiah($main['totalharga']) }}</th>
                                                </tr>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- MODAL --}}
        <x-modalsimpan judul="Tambah Item" link="jurnalitem">
            <input type="hidden" name="jurnal_id" value="{{ $jurnal->id }}">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Item</label>
                    <select name="item_id" id="item_id" class="form-select select2bs4">
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" name="harga" id="rupiah" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Detail</label>
                    <input type="text" name="detail" id="detail" class="form-control">
                </div>
            </section>
        </x-modalsimpan>
        <x-modalubah judul="Ubah Item" link="jurnalitem">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Item</label>
                    <select name="item_id" class="form-select select2bs4" data-width="100%">
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" name="harga" id="rupiah1" class="form-control">
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
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var item_id = button.data('item_id')
                var harga = button.data('harga')
                var detail = button.data('detail')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #item_id').val(item_id);
                modal.find('.modal-body #rupiah1').val(harga);
                modal.find('.modal-body #detail').val(detail);
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
