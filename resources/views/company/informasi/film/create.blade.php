<x-mazer-layout title="DUNIA FILM" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Film" active="Daftar Pencarian Film"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <a href="{{ url('informasi?id='.$kategori->id) }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i> Kembali </a>
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi-plus"></i> Cari Film Lainnya</a>
                            <span class="float-end">Key "{{ $key }}" ditemukan <strong>{{ count($data) }}</strong> Film</span>
                        </header>
                    </div>
                    <div class="col-md-12">
                        <section class="p-2">
                            <form action="{{ url('informasi') }}" method="post">
                                @csrf
                                <input type="hidden" name="sesi" value="film">
                                <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="bi-save"></i> SIMPAN HASIL PENCARIAN</button>
                                </div>
                            </form>
                        </section>
                        <div class="row">
                            @forelse ($data as $item)
                                <div class="col-12 col-sm-4 col-md-3">
                                    <div class="card">
                                        <div class="card-content">
                                            <a href="{{ $item->Poster}}" target="_blank"><img src="{{ $item->Poster}}" alt="user-avatar" class="card-img-top img-fluid"></a> <br>
                                        <section class="text-center py-2 small">
                                            {{ ucwords($item->Title)}}
                                        </section>
                                        </div>
                                        <div class="card-footer p-0">
                                            <form action="{{ url('informasi') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="sesi" value="film">
                                                <input type="hidden" name="page" value="singel">
                                                <input type="hidden" name="gambar" value="{{ $item->Poster }}">
                                                <input type="hidden" name="title" value="{{ $item->Title }}">
                                                <input type="hidden" name="id" value="{{ $item->imdbID }}">
                                                <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
                                                <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="bi-save"></i> SIMPAN</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <section class="text-center">
                                    <i>data tidak ditemukan</i>
                                </section>
                            @endforelse
                        </div>
                        <hr>
                        <div class="row">
                            @forelse ($simpan as $item)
                                <div class="col-12 col-sm-4 col-md-3">
                                    <div class="card">
                                        <div class="card-content">
                                            <a href="{{ $item->Poster}}" target="_blank"><img src="{{ $item->Poster}}" alt="user-avatar" class="card-img-top img-fluid"></a> <br>
                                        <section class="text-center py-2 small">
                                            {{ ucwords($item->Title)}}
                                        </section>
                                        </div>
                                        <div class="card-footer p-0">
                                            <button class="btn btn-success btn-sm btn-block"><i class="bi-save"></i> TERSIMPAN</button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                               
                            @endforelse
                        </div>
                    </div>
                  </div>
            </div>
        </div>
        <x-modal judul="Cari Judul Film" id="tambah">
            <form action="{{ url('informasi') }}" method="get">
                <input type="hidden" name="id" value="{{ $kategori->id }}">
                <input type="hidden" name="sesi" value="film">
                <input type="hidden" name="page" value="create">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Cari Judul Film</label>
                        <input type="text" name="cari" id="cari" class="form-control col-md-8" value="{{ $key }}" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Page</label>
                        <input type="number" name="page" id="page" value="{{ $_GET['page']}}" class="form-control col-md-8"  value="1">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="bi-search"></i> CARI FILM</button>
                    </div>
                </section>
            </form>
        </x-modal>
    </x-slot>
</x-mazer-layout>