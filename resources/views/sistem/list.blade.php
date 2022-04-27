<x-mazer-layout title="CHATOMZ - DETAIL GRUP" select="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header :head="$judul ?? ''">
            </x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @if (count($data['orang']) > 0)
                                    {{-- LIST ORANG --}}
                                    <div class="row d-flex align-items-stretch">
                                        <div class="col-12 mb-2">
                                            <button class="btn btn-info btn-sm">ORANG</button>
                                            <span class="float-end">Total {{ count($data['orang']) }}</span>
                                        </div>
                                        @forelse ($data['orang'] as $item)
                                            <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                                                <div class="card mb-3 w-100">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4">
                                                            <a href="{{ url('/orang/'.Crypt::encryptString($item->id))}}" target="_blank">
                                                                <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                                                            </a>
                                                        </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body p-2">
                                                        <h6 class="card-title">
                                                            {{ fullname($item)}} 
                                                            @if ($item->gender == 'laki-laki')
                                                                    <sup><i class="fas fa-mars text-primary"></i></sup>  
                                                                @else
                                                                    <sup><i class="fas fa-venus text-danger"></i></sup>  
                                                                @endif
                                                        </h6>
                                                        <small>{{ $item->home_address }}</small>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                                <div class="col text-center">
                                                    <i>Data tidak ada</i>
                                                </div>
                                            @endforelse
                                    </div>
                                @endif
                                @if (count($data['informasi']) > 0)
                                    {{-- LIST FILM --}}
                                    <div class="row d-flex align-items-stretch mt-3">
                                        <div class="col-12 mb-2">
                                            <button class="btn btn-info btn-sm">INFORMASI</button>
                                            <span class="float-end">Total {{ count($data['informasi']) }}</span>
                                        </div>
                                        @forelse ($data['informasi'] as $item)
                                            <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                                                <div class="card mb-3 w-100">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4 text-center">
                                                            <a href="{{ url('/informasi/'.$item->id)}}" target="_blank">
                                                                <img src="{{ asset('/img/company/informasi/'.$item->kategori->nama_kategori.'/'.$item->gambar)}}" class="card-img" alt="...">
                                                            </a>
                                                            <small class="fst-italic">{{ $item->kategori->nama_kategori }}</small>
                                                        </div>
                                                    <div class="col-md-8 pt-0 px-0">
                                                        <div class="card-body px-2 pt-0">
                                                        <h6 class="small">
                                                            {{ $item->nama }}
                                                        </h6>
                                                        @php
                                                            $detail = json_decode($item->detail)
                                                        @endphp
                                                        @isset($detail->Year)
                                                            <small>{{ $detail->Year }}</small>
                                                        @endisset
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                                <div class="col text-center">
                                                    <i>Data tidak ada</i>
                                                </div>
                                            @endforelse
                                    </div>
                                @endif
                                @if (count($data['orang']) == 0 AND count($data['informasi']) == 0)
                                    <section class="text-center">
                                        <i>Pencarian tidak ada yang cocok</i>
                                    </section>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-mazer-layout>