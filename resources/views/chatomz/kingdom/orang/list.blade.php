<x-mazer-layout title="CHATOMZ - DETAIL GRUP" select="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header :head="$judul ?? ''">
            </x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <span class="float-end">Total {{ count($orang) }}</span>
                        </div>
                        <div class="card-body">
                                <div class="row d-flex align-items-stretch">
                                    @forelse ($orang as $item)
                                        <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                                            <div class="card mb-3 w-100">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4">
                                                        <a href="{{ url('/orang/'.Crypt::encryptString($item->id))}}" target="_blank">
                                                            <img src="{{ asset('/img/chatomz/orang/'.$item->photo)}}" class="card-img" alt="...">
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
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-mazer-layout>
