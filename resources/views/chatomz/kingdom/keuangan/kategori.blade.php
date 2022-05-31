<x-singel-layout title="CHATOMZ - Keuangan" menu="keuangan" back="rekening">
    <x-slot name="content">
        <div class="page-heading">
            @php
                $detail = json_decode($rekening->detail) 
            @endphp
            <h3><i class="bi-{{ $detail->icon }} text-{{ $detail->warna }}"></i> Data Rekening - {{ ucwords($rekening->nama_rekening) }}</h3>
            <div class="section">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <x-sistem.kembali url="rekening/{{ $rekening->id }}"></x-sistem.kembali>
                                <table class="table table-borderless mt-3">
                                    @foreach ($main['kategori'] as $item)
                                        <tr>
                                            <th class="text-uppercase"><a href="{{ url('rekening/'.$rekening->id.'?s=kategori&id='.$item['kategori']->id) }}">{{ $item['kategori']->nama_kategori }}</a></th>
                                            <td>:</td>
                                            <td class="text-end">{{ norupiah($item['data']['jumlah']) }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body p-2">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">No</th>
                                                <th>Jurnal</th>
                                                <th class="text-center">Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-capitalize">
                                            @forelse ($jurnal as $item)
                                            <tr class="text-{{ keuanganWarnaArus($item->arus) }}">
                                                    <td class="text-center" rowspan="2">{{ $loop->iteration}}</td>
                                                    <td>{{ $item->nama_jurnal}}</td>
                                                    <td class="text-end" rowspan="2">{{ norupiah($item->nominal)}}</td>
                                                </tr>
                                                <tr class="text-{{ keuanganWarnaArus($item->arus) }}">
                                                    <td class="small fst-italic">{{ date_indo($item->tanggal).' - '.$item->nama_sub}}</td>
                                                </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="6">tidak ada data</td>
                                                </tr>
                                            @endforelse
                                                <tr class="text-primary">
                                                    <th colspan="2">Jumlah Pemasukan</th>
                                                    <th class="text-end">{{ norupiah($main['sesi']['pemasukan']) }}</th>
                                                </tr>
                                                <tr class="text-danger">
                                                    <th colspan="2">Jumlah Pengeluaran</th>
                                                    <th class="text-end">{{ norupiah($main['sesi']['pengeluaran']) }}</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">Total Sisa</th>
                                                    <th class="text-end">{{ norupiah($main['sesi']['hitung']) }}</th>
                                                </tr>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-singel-layout>
