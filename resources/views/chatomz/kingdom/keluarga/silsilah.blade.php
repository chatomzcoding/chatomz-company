<x-singel-layout title="CHATOMZ - Data Keluarga {{ $keluarga->nama_keluarga}}" back="orang">
    <x-slot name="content">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header p-3">
                <x-sistem.kembali url="keluarga/{{ Crypt::encryptString($keluarga->id) }}"></x-sistem.kembali>
                  <strong class="float-end">Pohon Keluarga</strong> 
              </div>
              <div class="card-body">
                  {{-- baris kepala keluarga dan istri --}}
                    <div class="row justify-content-center">
                        <div class="col-md-2">
                            <div class="card bg-primary mb-0">
                                <div class="card-body p-2 text-white text-center">
                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($pohon['suami']->photo))}}" class="img-fluid rounded-start">
                                    <small class="text-capitalize">{{ fullname($pohon['suami'])}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-info mb-0">
                                <div class="card-body p-2 text-white text-center">
                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($pohon['istri']->photo))}}" class="img-fluid rounded-start">
                                    <small class="text-capitalize">{{ fullname($pohon['istri'])}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- garis keturunan --}}
                <div class="row justify-content-center">
                    <div class="col-md-3 akar-utama d-none d-sm-block">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-3 akar-kiri d-none d-sm-block">
                    </div>
                    <div class="col-md-3 akar-kanan d-none d-sm-block">
                    </div>
                </div>
                @if (count($keluargahubungan) < 2)
                    <div class="row justify-content-center">
                        <div class="col-md-3 bg-secondary text-center small fst-italic text-white d-none d-sm-block">
                            belum ada data
                        </div>
                    </div>
                @endif
                <div class="row justify-content-center">
                    @if (count($keluargahubungan) >= 3 )
                        @for ($i = 2; $i < count($keluargahubungan); $i++)
                            @if ($i < 5)
                                <div class="col-md-3 akar-anak d-none d-sm-block">
                                </div>
                            @endif
                        @endfor
                    @endif
                    <div class="col d-block d-sm-none">
                        <hr>
                    </div>
                </div>

                <div class="row justify-content-center text-white">
                    @foreach ($keluargahubungan as $item)
                        @if ($item->status <> 'istri')
                            <div class="col-md-4 pt-2">
                                <div class="card bg-success mb-1">
                                    <div class="row no-gutters">
                                    <div class="col-4">
                                        <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->orang->photo))}}" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body p-2">
                                        <small class="text-capitalize">{{ fullname($item->orang)}}
                                            <br>
                                        anak ke {{ $item->urutan }} | <i>{{ $item->orang->gender }}</i></small>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                {{-- keturunan --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body p-2">
                                                <div class="row">
                                                    @if ($item->orang->gender == 'laki-laki')
                                                        @if (isset($item->orang->kepalakeluarga->anakketurunan))
                                                            @foreach ($item->orang->kepalakeluarga->anakketurunan as $key)
                                                            <div class="col">
                                                                <img src="{{ asset('/img/chatomz/orang/'.orang_photo($key->orang->photo))}}" class="img-fluid rounded" alt="...">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        ok
                                                                    </div>
                                                                    {{-- @if ($key->orang->gender == 'laki-laki')
                                                                        @if (isset($key->orang->kepalakeluarga->anakketurunan))
                                                                            @foreach ($key->orang->kepalakeluarga->anakketurunan as $k)
                                                                            <div class="col">
                                                                                <img src="{{ asset('/img/chatomz/orang/'.orang_photo($k->orang->photo))}}" class="img-fluid rounded" alt="...">
                                                                            </div>
                                                                            @endforeach
                                                                        @endif
                                                                    @else
                                                                        tidak
                                                                    @endif --}}
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @else
                                                        <section class="text-center small">
                                                            <i>belum ada data</i>
                                                        </section>
                                                        @endif
                                                    @else
                                                        @if (isset($item->orang->istri->keluarga->anakketurunan))
                                                            @foreach ($item->orang->istri->keluarga->anakketurunan as $key)
                                                                <div class="col">
                                                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($key->orang->photo))}}" class="img-fluid rounded" alt="...">
                                                                    <div class="row mt-2 text-dark">
                                                                        @if ($key->orang->gender == 'laki-laki')
                                                                            @if (isset($key->orang->kepalakeluarga->anakketurunan))
                                                                                @foreach ($key->orang->kepalakeluarga->anakketurunan as $k)
                                                                                <div class="col">
                                                                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($k->orang->photo))}}" class="img-fluid rounded" alt="...">
                                                                                </div>
                                                                                @endforeach
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <section class="text-center small">
                                                                <i>belum ada data</i>
                                                            </section>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
    </x-slot>
</x-singel-layout>
