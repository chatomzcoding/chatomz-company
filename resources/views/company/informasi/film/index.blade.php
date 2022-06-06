<x-mazer-layout title="DUNIA FILM" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Film" active="Daftar Film"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <a href="{{ url('informasi') }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i></a>
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi-plus"></i></a>
                            <button data-bs-toggle="modal" data-bs-target="#hapus" class="btn btn-outline-danger btn-sm"><i class="bi-trash"></i></button>
                            <button class="btn btn-outline-info btn-sm">{{ count($data) }}</button>
                        </header>
                    </div>
                    <div class="col-md-12">
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
                                        <form id="data-{{ $item->id }}" action="{{url('/informasi',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        @php
                                            $detail = json_decode($item->detail); 
                                        @endphp
                                        <div class="card-content position-relative area-hover">
                                            @if (is_null($item->gambar))
                                                <img src="{{ url('public/img/null.png')}}" alt="user-avatar" class="card-img-top img-fluid"> <br>
                                            @else
                                                <a href="{{ url('/informasi/'.$item->id)}}"><img src="{{ url('public/img/company/informasi/film/'.$item->gambar)}}" alt="user-avatar" class="card-img-top img-fluid"></a> <br>
                                            @endif
                                            <section class="text-center py-2 small">
                                                {{ ucwords($item->nama)}}
                                                @if (isset($detail->Year))
                                                    <i>({{ $detail->Year}})</i>
                                                @endif
                                                <br>
                                                <span class="text-primary">
                                                    {{ informasiShowTag($item->tag) }}
                                                </span>
                                            </section>
                                            <div class="position-absolute top-0 end-0 button-hover">
                                                <button type="button" data-bs-toggle="modal"  data-tag="{{ $item->tag }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="btn btn-success btn-sm" data-original-title="Edit Task">
                                                    <i class="bi-pen"></i>
                                                </button>
                                                <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm"><i class="bi-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- list untuk ditambahkan ke daftar tag --}}
                        </div>
                        <form action="{{ url('informasi') }}" method="post">
                            @csrf
                            <input type="hidden" name="sesi" value="film">
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
                                                            <a href="{{ url('/informasi/'.$item->id)}}"><img src="{{ url('public/img/company/informasi/film/'.$item->gambar)}}" alt="user-avatar" class="card-img-top img-fluid"></a> <br>
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
        <x-modal judul="Hapus Semua Data" id="hapus">
            <section class="text-center">
                <a href="{{ url('informasi?id='.$kategori->id.'&hapus=TRUE') }}" class="btn btn-danger btn-sm">Hapus Semua</a>
            </section>
        </x-modal>
        <x-modal judul="Cari Judul Film" id="tambah">
            <form action="{{ url('informasi') }}" method="get">
                <input type="hidden" name="id" value="{{ $kategori->id }}">
                <input type="hidden" name="sesi" value="film">
                <input type="hidden" name="page" value="create">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Cari Judul Film</label>
                        <input type="text" name="cari" id="cari" class="form-control col-md-8" value="{{ old('cari')}}" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Page</label>
                        <input type="number" name="page" id="page" class="form-control col-md-8"  value="1">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="bi-search"></i> CARI FILM</button>
                    </div>
                </section>
            </form>
        </x-modal>
        <x-modalubah judul="Edit Film" link="informasi">
                <input type="hidden" name="sesi" value="film">
                <section class="p-3">
                    @foreach (informasiListTag($kategori->list_tag) as $item)
                        <button class="btn btn-{{ informasiTagAktif($tag,$item)}} btn-sm"><i>#{{ $item }}</i></button>
                    @endforeach
                    <div class="form-group mt-2">
                        <label for="">Tag Film</label>
                        <textarea name="tag" id="tag" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var tag = button.data('tag')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #tag').val(tag);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>