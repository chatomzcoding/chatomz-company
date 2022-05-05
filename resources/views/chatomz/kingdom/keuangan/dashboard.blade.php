<x-mazer-layout title="CHATOMZ - Keuangan" menu="keuangan">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Dashboard Rekening" active="Statistik Keuangan"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-2">
                                <x-sistem.kembali url="rekening"></x-sistem>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="bi-piggy-bank"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total</h6>
                                        <h6 class="font-extrabold mb-0">{{ norupiah($statistik['total']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="bi-cash"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Cash</h6>
                                        <h6 class="font-extrabold mb-0">{{ norupiah($statistik['cash']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="bi-bank"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Bank</h6>
                                        <h6 class="font-extrabold mb-0">{{ norupiah($statistik['bank']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="bi-wallet"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">E-Money</h6>
                                        <h6 class="font-extrabold mb-0">{{ norupiah($statistik['e-money']) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5>TOTAL JURNAL BERDASARKAN KATEGORI</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        {{-- <thead>
                                            <tr>
                                                <th>Kategori</th>
                                            </tr>
                                        </thead> --}}
                                        <tbody>
                                            @foreach ($kategori as $namakategori => $listsubkategori)
                                                <tr>
                                                    <th class="text-uppercase" colspan="2">{{ $namakategori }}</th>
                                                </tr>
                                                @foreach ($listsubkategori as $namasub => $listdata)
                                                    <tr>
                                                        <td class="text-capitalize">
                                                            &nbsp;&nbsp; {{ $namasub }}
                                                        </td>
                                                        <td class="text-end">{{ norupiah(PerhitunganDompet($listdata,0)['jumlah']) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-mazer-layout>
