<x-mazer-layout title="COMPANY - Informasi">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi" active="Daftar Informasi"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah  </a> --}}
                            </div>
                            <div class="card-body">
                                    <div class="row d-flex align-items-stretch">
                                        @foreach ($kategori as $item)
                                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                                <div class="card">
                                                    <div class="card-header border-bottom-0 text-uppercase text-center p-3">
                                                    {{ $item->nama_kategori}}
                                                    </div>
                                                    <div class="card-body pb-0">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <a href="{{ url('/informasi?id='.$item->id)}}"><img src="{{ asset('/img/kategori/'.$item->gambar)}}" alt="user-avatar" class="img-fluid rounded border border-4"></a>
                                                            </div>
                                                            {{-- <div class="col-md-12">
                                                                <p class="small"><b>00</b></p>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-mazer-layout>
