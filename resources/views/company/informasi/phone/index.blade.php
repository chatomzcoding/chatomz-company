<x-mazer-layout title="DUNIA PHONE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Phone" active="Daftar Phone Brand" :hyperlink="['daftar informasi' => 'informasi']"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <form id="datainformasi-{{ $kategori->id }}" action="{{url('/kategori',$kategori->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="sesi" value="informasi">
                        </form>
                        <header class="bg-white mb-2 p-2 rounded">
                            <a href="{{ url('informasi') }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i></a>
                            <a href="{{ url('informasi/create?kategori_id='.$kategori->id) }}" class="btn btn-outline-primary btn-flat btn-sm"><i class="bi-plus"></i></a>
                            <button onclick="deleteRow( {{ $kategori->id }},'datainformasi' )" class="btn btn-outline-danger btn-sm"><i class="bi-trash"></i></button>
                            <button class="btn btn-outline-info btn-sm">{{ count($data) }}</button>
                        </header>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($data as $item)
                                <div class="col-12 col-sm-4 col-md-3">
                                    <form id="data-{{ $item->id }}" action="{{url('/informasi',$item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <div class="card">
                                        @php
                                            $detail = json_decode($item->detail); 
                                        @endphp
                                        <div class="card-content position-relative area-hover">
                                            @if (is_null($item->gambar))
                                                <img src="{{ url('public/img/null.png')}}" alt="user-avatar" class="card-img-top img-fluid"> <br>
                                            @else
                                                <a href="{{ url('/informasi/'.$item->id)}}"><img src="{{ url('public/img/company/informasi/phone/'.$item->gambar)}}" alt="user-avatar" class="card-img-top img-fluid"></a> <br>
                                            @endif
                                            <section class="text-center py-2 small">
                                                {{ ucwords($item->nama)}} <br>
                                                {{ ($detail->jumlah) }}
                                            </section>
                                            <section class="position-absolute top-0 end-0 button-hover">
                                                <button type="button" data-bs-toggle="modal"  data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="btn btn-success btn-sm">
                                                    <i class="bi-pen"></i>
                                                </button>
                                                <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm"><i class="bi-trash"></i></button>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- list untuk ditambahkan ke daftar tag --}}
                        </div>
                    </div>
                  </div>
            </div>
        </div>
        <x-modalubah judul="Edit Phone" link="informasi">
                <input type="hidden" name="sesi" value="phone">
                <section class="p-3">
                    <div class="form-group mt-2">
                        <label for="">Gambar Brand Phone</label>
                        <input type="file" name="gambar">
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