<x-mazer-layout title="Barang - Dashboard" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Dashboard Barang" active="Informasi Barang"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-2">
                                <x-sistem.kembali url="barang"></x-sistem.kembali>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body p-2">
                                <small>Total Asset</small> <br>
                                <div class="text-end">
                                    {{ norupiah($totalasset) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body p-2">
                                <small>Total Barang</small> <br>
                                <div class="text-end">
                                    {{ count($barang) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-mazer-layout>
