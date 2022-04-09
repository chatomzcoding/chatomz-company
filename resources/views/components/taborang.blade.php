<section>
    <ul class="nav nav-tabs" id="{{ $id }}" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="{{ $id}}-chart" data-bs-toggle="tab" href="#{{ $id}}-chart"
                    role="tab" aria-controls="{{ $id}}-chart" aria-selected="true">Statistik</a>
        </li>
        @foreach ($orang as $j => $d)
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ statusmenustatistik($t,$loop->iteration) }}" id="{{ $loop->iteration }}-tab" data-bs-toggle="tab" href="#{{ $tab.$loop->iteration }}"
                    role="tab" aria-controls="{{ $tab.$loop->iteration }}" aria-selected="true">{{ $j.$loop->iteration }} <span class="badge bg-primary">{{ count($d) }}</span></a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="{{ $id }}content">
        <div class="tab-pane fade {{ statusmenustatistik($t,0) }}" id="{{ $id}}-chart" role="tabpanel" aria-labelledby="home-tab">
            <div class="row d-flex align-items-stretch mt-2">
                <div class="col-md-12 text-center">
                    <div class="card">
                        <div class="card-body">
                            <div id="{{ $showchart ?? '' }}"></div>
                        </div>
                    </div>
                </div>
            </div>                                 
        </div>
        @php
            $not = 1
        @endphp
        @foreach ($orang as $j => $d)
            <div class="tab-pane fade {{ statusmenustatistik($t,$not) }}" id="{{ $tab.$not }}" role="tabpanel" aria-labelledby="home-tab">
                <div class="row d-flex align-items-stretch mt-4">
                    @forelse ($d as $item)
                        <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                            <div class="card mb-3 w-100">
                                <div class="row no-gutters">
                                    @if ($photo == 'aktif')
                                        <div class="col-md-4">
                                            <a href="{{ url('/orang/'.Crypt::encryptString($item->id))}}" target="_blank">
                                                <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                                            </a>
                                        </div>
                                    @endif
                                    @php
                                        $col = ($photo == 'aktif') ? 'col-md-8' : 'col';
                                    @endphp
                                        <div class="{{ $col }}">
                                            <div class="card-body p-0">
                                            <h6 class="card-title" style="font-size: 14px">
                                                {{ fullname($item).$not}} 
                                                @if ($item->gender == 'laki-laki')
                                                        <sup><i class="fas fa-mars text-primary"></i></sup>  
                                                    @else
                                                        <sup><i class="fas fa-venus text-danger"></i></sup>  
                                                    @endif
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#ubah" data-id="{{ $item->id }}" data-m="{{ $m }}" data-t="{{ $not }}" data-nama="{{ fullname($item) }}" data-date_birth="{{ $item->date_birth }}" data-gender="{{ $item->gender }}" data-note="{{ $item->note }}" data-marital_status="{{ $item->marital_status }}" data-status_group="{{ $item->status_group }}" data-home_address="{{ $item->home_address }}" data-place_birth="{{ $item->place_birth }}" data-blood_type="{{ $item->blood_type }}" data-death="{{ $item->death }}" ><i class="bi-pencil float-end text-success"></i></a>
                                            </h6>
                                            @if ($konten == 'fase')
                                                <small style="font-size: 12px">{{ date_indo($item->date_birth) }}
                                                <br>Usia : {{ age($item->date_birth) }}</small>
                                            @endif
                                            @if ($konten == 'data')
                                                <small style="font-size: 11px">{{ $item->home_address }}</small>
                                            @endif
                                            {{ $slot }}
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
            @php
                $not++
            @endphp
        @endforeach
    </div>
</section>

