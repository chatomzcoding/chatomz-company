<x-mazer-layout title="CHATOMZ - Data Item" datatables="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Item {{ ucwords($item->nama_item) }}" active="Daftar Jurnal">
            </x-header>
            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <x-sistem.kembali url="item"></x-sistem.kembali>
                            </div>
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
                                            @forelse ($item->jurnalitem as $item)
                                            <tr>
                                                    <td class="text-center">{{ $loop->iteration}}</td>
                                                    <td>{{ $item->jurnal->nama_jurnal}}</td>
                                                    <td>{{ date_indo($item->jurnal->tanggal)}}</td>
                                                    <td class="text-end">{{ norupiah($item->harga)}}</td>
                                                    <td>{{ $item->diskon}}</td>
                                                    <td>{{ $item->jumlah.' '.$item->satuan}}</td>
                                                    <td class="text-end">{{ norupiah(subtotal($item->jumlah,$item->harga,$item->diskon))}}</td>
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
    </x-slot>
</x-mazer-layout>
