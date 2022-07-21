<x-mazer-layout title="CHATOMZ - Detail Orang" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Orang" p="Detail {{ fullname($orang) }}" active="Detail">
                <li class="breadcrumb-item"><a href="{{ url('orang')}}">Daftar Orang</a></li>
            </x-header>
            <section class="section">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="card">
                            <div class="card-content position-relative area-hover">
                                <button class="btn btn-success btn-sm button-hover position-absolute top-0 end-0" data-bs-toggle="modal" data-bs-target="#ubahphoto"><i class="bi-image"></i></button>
                                <a href="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}" target="_blank">
                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}" class="card-img-top img-fluid"
                                    alt="singleminded">
                                </a>
                                <div class="card-body py-2">
                                    <section class="text-center">
                                        <h5 class="card-title">{!! kingdom_fullname($orang) !!}</h5>
                                        <span>{{ age($orang->date_birth,'Bulan')}}</span>
                                        <p class="card-text fst-italic">
                                           "{{ $orang->note }}"
                                        </p>
                                    </section>
                                    <form id="data-{{ $orang->id }}" action="{{url('/orang/'.$orang->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <hr>
                                    <div class="d-flex justify-content-center">
                                        <section class="p-1">
                                            <button onclick="deleteRow( {{ $orang->id }} )" class="btn btn-icon btn-round btn-danger pop-info" title="hapus orang"><i class="bi-trash"></i></button>
                                        </section>
                                        <section class="p-1">
                                            <a href="{{ url('orang/'.Crypt::encryptString($orang->id).'/edit')}}" class="btn btn-icon btn-round btn-success pop-info" title="Edit Orang">
                                                    <i class="bi-pencil"></i></a>
                                        </section>
                                        @if (Auth::user()->level == 'admin')
                                            <section class="p-1">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#grup">
                                                    <button type="button" class="btn btn-icon btn-round btn-info pop-info" title="anggota grup">
                                                        <i class="bi-person-badge"></i>
                                                    </button>
                                                </a>
                                            </section>
                                        @endif
                                        @if ($orang->marital_status == 'sudah' || count($keluarga) > 0)
                                            <section class="p-1">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#keluarga" class="btn btn-icon btn-round btn-secondary pop-info" title="lihat silsilah keluarga">
                                                        <i class="bi-diagram-3"></i></a>
                                            </section>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true"><i class="bi bi-people"></i></a>
                                    </li>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="p-3">
                                            <strong><i class="bi-geo-alt"></i> Alamat</strong>
                                            <div class="py-0 px-3">
                                                <p class="text-muted">
                                                  {{ $orang->home_address }}
                                                </p>
                                            </div>
                                            <strong><i class="bi-house-door mr-1"></i> Tempat Lahir</strong>
                                            <div class="py-0 px-3">
                                                  <p class="text-muted">{{ $orang->place_birth.', '.date_indo($orang->date_birth)}}</p>
                                            </div>
                                            <strong><i class="bi-star"></i> Agama</strong>
                                            <div class="py-0 px-3">
                                                <p class="text-muted">
                                                  {{ $orang->religion}}
                                                </p>
                                            </div>
                                            <strong><i class="bi-briefcase mr-1"></i> Status Pekerjaan</strong>
                                            <div class="py-0 px-3">
                                                <p class="text-muted">
                                                  {{ $orang->job_status}}
                                                </p>
                                            </div>
                                            <strong><i class="bi-heart mr-1"></i> Status Perkawinan</strong>
                                            <div class="py-0 px-3">
                                                <p class="text-muted">
                                                  {{ $orang->marital_status}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        {{-- modal keluarga --}}
        <x-modal judul="Riwayat Keluarga" id="keluarga">
            <section class="row p-3">
                @if (count($suami) > 0)
                    @foreach ($suami as $item)
                        <div class="col-md-12">
                            <a href="{{ url('/keluarga/'.Crypt::encryptString($item->id)) }}">
                            <div class="card bg-primary">
                                <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-2 text-white">
                                        <small class="text-capitalize">{{ fullname($orang)}}
                                        <br>
                                        <i>Kepala Keluarga</i> <br> {{ $item->nama_keluarga }}</small>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                @endif

                @if (count($keluarga) == 0)
                    @if ($orang->gender == 'perempuan' AND $orang->marital_status == 'sudah' AND count($daftarkeluarga) > 0)
                        <section class="col-md-12 text-center">
                            <small class="font-italic">Memenuhi syarat menjadi seorang istri</small> <br>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#tambahkeluarga" class="btn btn-primary btn-sm">Tambahkan keluarga</a>
                        </section>
                    @else
                        <section class="text-center">
                            <small class="font-italic">belum ada keluarga yang dibuat</small>
                        </section>
                    @endif
                @endif
                
                @foreach ($keluarga as $item)
                @if ($item->status == 'istri')
                    <div class="col-md-12">
                        <a href="{{ url('/keluarga/'.Crypt::encryptString($item->keluarga_id)) }}">
                        <div class="card bg-info">
                            <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-2 text-white">
                                    <small class="text-capitalize">{{ fullname($item)}}
                                    <br>
                                <i>{{ $item->status }}</i> <br> {{ $item->nama_keluarga }}</small>
                                </div>
                            </div>
                            </div>
                        </div>
                        </a>
                    </div>
                @endif
                @if ($item->status == 'anak')
                    <div class="col-md-12">
                        <a href="{{ url('/keluarga/'.Crypt::encryptString($item->keluarga_id)) }}">
                        <div class="card bg-success">
                            <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-2 text-white">
                                    <small class="text-capitalize">{{ fullname($item)}}
                                    <br>
                                <i>{{ $item->status .' - '. $item->urutan }}</i> <br> {{ $item->nama_keluarga }}</small>
                                </div>
                            </div>
                            </div>
                        </div>
                        </a>
                    </div>
                @endif
                @endforeach
            </section>
        </x-modal>

        <x-modalubah judul="Ubah Poto" id="ubahphoto" link="orang">
            <input type="hidden" name="id" value="{{ $orang->id }}">
            <input type="hidden" name="sesi" value="ubahphoto">
            <section class="p-3">
                <div class="form-group">
                    <input type="file" name="photo" required>
                </div>
            </section>
        </x-modalubah>

    </x-slot>

</x-mazer-layout>
