<x-mazer-layout title="CHATOMZ - Keuangan" menu="keuangan">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Rekening" active="Daftar Rekening"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-2">
                                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus"></i></a>
                                <a href="{{ url('rekening?s=dashboard') }}" class="btn btn-outline-info btn-flat btn-sm"><i class="bi bi-bar-chart"></i></a>
                                <a href="{{ url('rekening?s=manajemen') }}" class="btn btn-outline-success btn-flat btn-sm"><i class="bi bi-bookmark-plus"></i></a>
                                <span class="float-end pt-2 fw-bold">{{ norupiah($total) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row d-flex align-items-stretch">
                            @foreach ($data as $item)
                                @php
                                    $d = json_decode($item['row']->detail);
                                @endphp
                                <div class="col-lg-4 col-sm-6">
                                    <a href="{{ url('rekening/'.$item['row']->id) }}">
                                        <div class="card">
                                            <div class="card-body py-3 px-3 bg-{{ $d->warna }} rounded">
                                                <div class="d-flex align-items-center text-white">
                                                    <div class="avatar avatar-xl">
                                                        <i class="bi-{{ $d->icon }}" style="font-size: 35px;"></i>
                                                    </div>
                                                    <div class="ms-2 name">
                                                        <h5 class="font-bold small text-white"> {{ $item['row']->nama_rekening}}</h5>
                                                        <h6 class="text-light mb-0 small">{{ rupiah($item['sisa']) }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- MODAL --}}
        <x-modalsimpan judul="Tambah Rekening Baru" link="rekening">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Rekening</label>
                    <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Saldo Awal</label>
                    <input type="text" name="saldo_awal" id="rupiah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Saldo Minimum</label>
                    <input type="text" name="saldo_minimum" id="rupiah1" value="0" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Jenis Rekening</label>
                    <select name="jenis" id="jenis" class="form-control">
                        <option value="cash">CASH</option>
                        <option value="bank">BANK</option>
                        <option value="e-money">E-MONEY</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tentang Rekening</label>
                    <input type="text" name="tentang" id="tentang" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Icon Rekening</label>
                    <input type="text" name="icon" id="icon" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Warna</label>
                    <input type="text" name="warna" id="warna" class="form-control" required>
                </div>
            </section>
        </x-modalsimpan>
    </x-slot>
</x-mazer-layout>
