<x-mazer-layout title="TEMPAT" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Tempat" active="Daftar Tempat"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <x-sistem.tambah url="tempat/create"></x-sistem.tambah>
                            <a href="{{ url('tempat?s=map') }}" class="btn btn-outline-info btn-sm"><i class="bi-geo"></i></a>
                        </header>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            @foreach ($tempat as $item)
                                <div class="col-12 col-sm-4 col-md-3">
                                    <form id="data-{{ $item->id }}" action="{{url('/tempat',$item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                <div class="card">
                                    <div class="card-content position-relative area-hover">
                                        <a href="{{ url('/tempat/'.$item->id)}}">
                                            @if (is_null($item->gambar))
                                                <img src="{{ url('public/img/tempat.png')}}" alt="user-avatar"   class="card-img-top img-fluid">
                                            @else
                                                <img src="{{ url('public/img/company/tempat/'.$item->gambar)}}" alt="user-avatar" class="card-img-top img-fluid">
                                            @endif
                                        </a> <br>
                                        <section class="text-center py-2 small">
                                            {{ ucwords($item->nama)}} <br>
                                            <span class="text-muted fst-italic">
                                                {{ $item->alamat }}
                                            </span>
                                        </section>
                                        <section class="position-absolute top-0 end-0 button-hover">
                                            <a href="{{ url('tempat/'.$item->id.'/edit') }}" class="btn btn-success btn-sm"><i class="bi-pencil"></i></a>
                                            <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm "><i class="bi-trash"></i></button>
                                        </section>
                                    </div>
                                    <div class="card-footer p-0">
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