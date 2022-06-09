<x-mazer-layout title="CHATOMZ - Data Item" datatables="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header p-0">
                                                <h5>
                                                    {{ ucwords($item->nama_item) }}
                                                </h5>
                                            </div>
                                            <div class="card-body p-0">
                                                @if (!is_null($item->gambar_item))
                                                    <img src="{{ asset('img/chatomz/item/'.$item->gambar_item) }}" alt="" class="img-fluid">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <section class="mb-2">
                                            <x-sistem.kembali url="item"></x-sistem.kembali>
                                            <x-sistem.edit></x-sistem.edit>
                                        </section>
                                        <section class="row my-1">
                                            <div class="col">
                                                <div class="card bg-info">
                                                    <div class="card-body text-white pb-0">
                                                        <h6 class="text-white">ITEM</h6>
                                                        <p>{{ $statistik['total_item'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card bg-success text-white">
                                                    <div class="card-body pb-0">
                                                        <h6 class="text-white">DISKON</h6>
                                                        <p>{{ norupiah($statistik['total_diskon'],0) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card bg-primary text-white">
                                                    <div class="card-body pb-0">
                                                        <h6 class="text-white">PEMBELIAN</h6>
                                                        <p>{{ norupiah($statistik['total_pembelian'],0) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-borderless table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Jurnal</th>
                                                <th>Tanggal</th>
                                                <th>Harga</th>
                                                <th>Diskon</th>
                                                <th>Kuantitas</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-capitalize">
                                            @forelse ($jurnal as $key)
                                            <tr>
                                                    <td class="text-center">{{ $loop->iteration}}</td>
                                                    <td><a href="{{ url('jurnal/'.$key->jurnal->id) }}">{{ $key->jurnal->nama_jurnal}}</a></td>
                                                    <td>{{ date_indo($key->jurnal->tanggal)}}</td>
                                                    <td class="text-end">{{ norupiah($key->harga)}}</td>
                                                    <td class="text-end">{{ norupiah($key->diskon)}}</td>
                                                    <td>{{ $key->jumlah.' '.$key->satuan}}</td>
                                                    <td class="text-end">{{ norupiah(subtotal($key->jumlah,$key->harga,$key->diskon))}}</td>
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
        <x-modalubah judul="ubah data Item" link="item">
            <input type="hidden" name="id" value="{{ $item->id }}">
            <section class="p-3">
                <div class="form-group row">
                    <label for="" class="col-md-4">Nama Item {!! ireq() !!}</label>
                    <input type="text" name="nama_item" value="{{ $item->nama_item }}" class="form-control col-md-8" required>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Kelompok {!! ireq() !!}</label>
                    <select name="kelompok" class="form-control">
                        @foreach ($kelompok as $key)
                            <option value="{{ $key->nama_kategori }}" {{ syselected($key->nama_kategori,$item->kelompok) }}>{{ $key->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Keterangan</label>
                    <textarea name="keterangan" cols="30" rows="3" class="form-control col-md-8">{{ $item->keterangan }}</textarea>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-4">Gambar</label>
                    <input type="file" name="gambar_item" id="gambar" class="form-control col-md-8">
                </div>
            </section>
        </x-modalubah>
    </x-slot>
</x-mazer-layout>
