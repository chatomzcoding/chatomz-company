<x-mazer-layout title="DUNIA MASAKAN" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Masakan" active="Daftar Resep Masakan"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <a href="{{ url('informasi?id='.$kategori->id) }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i> Kembali </a>
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi-plus"></i> Cari Resep Lainnya</a>
                                <span class="float-end">Key "{{ $key }}" ditemukan <strong>{{ count($data) }}</strong> Resep Masakan</span>
                        </header>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @forelse ($data as $item)
                                <div class="col-12 col-sm-4 col-md-3">
                                <div class="card">
                                    <div class="card-content">
                                        <a href="{{ $item['data']->thumb}}" target="_blank"><img src="{{ $item['data']->thumb}}" alt="user-avatar" class="card-img-top img-fluid"></a> <br>
                                    <section class="text-center py-2 small">
                                        {{ ucwords($item['data']->title)}}
                                    </section>
                                    </div>
                                    <div class="card-footer p-0">
                                        @if ($item['status'])
                                            <button class="btn btn-success btn-sm btn-block"><i class="bi-save"></i> TERSIMPAN</button>
                                        @else
                                            <form action="{{ url('informasi') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="sesi" value="masakan">
                                                <input type="hidden" name="page" value="singel">
                                                <input type="hidden" name="thumb" value="{{ $item['data']->thumb }}">
                                                <input type="hidden" name="title" value="{{ $item['data']->title }}">
                                                <input type="hidden" name="key" value="{{ $item['data']->key }}">
                                                <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
                                                <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="bi-save"></i> SIMPAN</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                </div>
                                @empty
                                  <section class="text-center">
                                      <i>data tidak ditemukan</i>
                                  </section>
                                @endforelse
                        </div>
                    </div>
                  </div>
            </div>
        </div>
        <x-modal judul="Cari Data Resep Masakan" id="tambah">
            <form action="{{ url('informasi') }}" method="get">
            <input type="hidden" name="id" value="{{ $kategori->id }}">
            <input type="hidden" name="page" value="create">
            <section class="p-3">
                <div class="form-group">
                     <label for="">Cari Resep Masakan</label>
                     <input type="text" name="cari" id="cari" class="form-control" value="{{ old('cari')}}" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="bi-search"></i> CARI</button>
                </div>
             </section>
            </form>
        </x-modal>
    </x-slot>
</x-mazer-layout>