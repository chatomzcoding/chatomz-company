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
                                    {!! kingdom_orangpoto($pohon['suami']->photo,$pohon['suami']->id) !!}
                                    <small class="text-capitalize">{{ fullname($pohon['suami'])}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-info mb-0">
                                <div class="card-body p-2 text-white text-center">
                                    {!! kingdom_orangpoto($pohon['istri']->photo,$pohon['istri']->idorang) !!}
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
                            <div class="col-md-3 pt-2">
                                <div class="card bg-success mb-1">
                                    <div class="row no-gutters">
                                    <div class="col-5">
                                        {!! kingdom_orangpoto($item->orang->photo,$item->orang->id) !!}
                                    </div>
                                    <div class="col-7">
                                        <div class="card-body px-0 py-2">
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
                                            <div class="card-body p-0 text-dark">
                                                <hr>
                                                @foreach (kingdom_keturunan($item->orang) as $key)
                                                    <div class="row border mb-2 mx-0">
                                                        <div class="col-4 p-0 position-relative">
                                                            <span class="position-absolute top-0 start-0 badge bg-info">{{ $loop->iteration }}</span>
                                                            {!! kingdom_orangpoto($key->orang->photo,$key->orang->id,'') !!}
                                                            <section class="text-center">
                                                                <small>{{ fullname($key->orang) }}</small>
                                                            </section>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="row mt-1 p-0">
                                                                @foreach (kingdom_keturunan($key->orang) as $k)
                                                                    <div class="col-3 p-1">
                                                                        {!! kingdom_orangpoto($k->orang->photo,$k->orang->id,'rounded-circle') !!}
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
