<x-mazer-layout title="COMPANY - Informasi">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi" active="Daftar Informasi"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row d-flex align-items-stretch">
                            @foreach ($kategori as $item)
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                    <div class="card">
                                        <div class="card-content">
                                            <a href="{{ url('/informasi?id='.$item->id)}}"><img src="{{ asset('/img/kategori/'.$item->gambar)}}" alt="user-avatar" class="card-img-top img-fluid"></a>
                                            <section class="text-center p-2">
                                                {{ $item->nama_kategori}}
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-mazer-layout>
