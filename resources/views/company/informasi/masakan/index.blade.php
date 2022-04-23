<x-mazer-layout title="DUNIA MASAKAN" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Masakan" active="Daftar Resep Masakan"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <a href="{{ url('informasi') }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i> Kembali </a>
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi-plus"></i> Tambah Masakan </a>
                            <button data-bs-toggle="modal" data-bs-target="#hapus" class="btn btn-outline-danger btn-sm"><i class="bi-trash"></i> Hapus Semua</button>
                        </header>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a href="{{ url('informasi?id='.$kategori->id) }}" class="btn btn-{{ informasiTagAktif($tag,NULL) }} btn-sm"><i>#semua @if (is_null($tag))
                                    {{ count($data) }}
                                @endif </i></a>
                                @foreach (informasiListTag($kategori->list_tag) as $item)
                                    <a href="{{ url('informasi?id='.$kategori->id.'&tag='.$item) }}" class="btn btn-{{ informasiTagAktif($tag,$item)}} btn-sm"><i>#{{ $item }} @if ($item == $tag)
                                        ({{ count($data) }})
                                    @endif</i></a>
                                @endforeach
                            </div>
                            @foreach ($data as $item)
                                <div class="col-12 col-sm-4 col-md-3">
                                <div class="card">
                                    @php
                                        $detail = json_decode($item->detail); 
                                    @endphp
                                    <div class="card-content">
                                        <a href="{{ url('/informasi/'.$item->id)}}"><img src="{{ url('public/img/company/informasi/masakan/'.$item->gambar)}}" alt="user-avatar" class="card-img-top img-fluid"></a> <br>
                                    <section class="text-center py-2 small">
                                        {{ ucwords($item->nama)}}
                                        <span class="text-primary">
                                            {{ informasiShowTag($item->tag) }}
                                        </span>
                                    </section>
                                    </div>
                                    <div class="card-footer p-0">
                                        <form id="data-{{ $item->id }}" action="{{url('/informasi',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm btn-block"><i class="fas fa-trash-alt"></i> HAPUS</button>
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <form action="{{ url('informasi') }}" method="post">
                                @csrf
                                <input type="hidden" name="sesi" value="masakan">
                                <input type="hidden" name="s" value="tag">
                                <input type="hidden" name="tag" value="{{ $tag }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Tambahkan Ke Tag #{{ $tag }}</h3>
                                    </div>
                                    @if (!is_null($datas))
                                        @foreach ($datas as $item)
                                            @if (!preg_match('/'.$tag."/i",$item->tag))
                                                <div class="col-12 col-sm-4 col-md-3">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            @if (is_null($item->gambar))
                                                                <img src="{{ url('public/img/null.png')}}" alt="user-avatar" class="card-img-top img-fluid"> <br>
                                                            @else
                                                                <a href="{{ url('/informasi/'.$item->id)}}"><img src="{{ url('public/img/company/informasi/masakan/'.$item->gambar)}}" alt="user-avatar" class="card-img-top img-fluid"></a> <br>
                                                            @endif
                                                        <section class="text-center py-2 small">
                                                            {{ ucwords($item->nama)}}
                                                        </section>
                                                        <section class="text-center">
                                                            <input type="checkbox" name="id[]" value="{{ $item->id }}"> Tambahkan
                                                        </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block">SIMPAN DATA</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
        <x-modal judul="Hapus Semua Data" id="hapus">
            <section class="text-center">
                <a href="{{ url('informasi?id='.$kategori->id.'&hapus=TRUE') }}" class="btn btn-danger btn-sm">Hapus Semua</a>
            </section>
        </x-modal>
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