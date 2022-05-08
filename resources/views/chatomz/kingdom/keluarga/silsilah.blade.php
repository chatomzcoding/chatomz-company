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
                                    <small>{!! kingdom_fullname($pohon['suami'])!!}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card bg-info mb-0">
                                <div class="card-body p-2 text-white text-center">
                                    {!! kingdom_orangpoto($pohon['istri']->photo,$pohon['istri']->orang->id) !!}
                                    <small>{!! kingdom_fullname($pohon['istri']->orang)!!}</small>
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
                @if ($jumlahanak < 2)
                    <div class="row justify-content-center">
                        <div class="col-md-3 bg-secondary text-center small fst-italic text-white d-none d-sm-block">
                            belum ada data
                        </div>
                    </div>
                @endif
                <div class="row justify-content-center">
                    @if ($jumlahanak >= 3 )
                        @for ($i = 1; $i < $jumlahanak; $i++)
                            @if ($i < 5)
                                <div class="col-md-2 akar-anak d-none d-sm-block">
                                </div>
                            @endif
                        @endfor
                    @endif
                    <div class="col d-block d-sm-none">
                        <hr>
                    </div>
                </div>

                <div class="row justify-content-center text-white">
                    @foreach ($keluarga->anakketurunan as $item)
                            <div class="col-md-2 pt-2">
                                <div class="card bg-success mb-1 position-relative">
                                    <div class="row">
                                    <div class="col-5">
                                        <span class="position-absolute badge bg-info top-0 start-0">{{ $loop->iteration }}</span>
                                        {!! kingdom_orangpoto($item->orang->photo,$item->orang->id) !!}
                                    </div>
                                    <div class="col-7">
                                        <div class="card-body px-0 py-2">
                                        <small>{!! kingdom_fullname($item->orang)!!}
                                       </small>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                {{-- keturunan --}}
                                <div class="row">
                                    @php
                                        $no = 1
                                    @endphp
                                    @foreach (kingdom_keturunan($item->orang) as $key)
                                        @if ($no == 1)
                                            <div class="col-12 text-dark">
                                                <hr>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <div class="card bg-success mb-1">
                                                <div class="row position-relative">
                                                <div class="col-4">
                                                    <span class="position-absolute badge bg-info top-0 start-0">{{ $no }}</span>
                                                    {!! kingdom_orangpoto($key->orang->photo,$key->orang->id) !!}
                                                </div>
                                                <div class="col-8 p-0">
                                                    <small>{!! kingdom_fullname($key->orang)!!}
                                                   </small>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2 justify-content-center px-2 mb-2">
                                                @foreach (kingdom_keturunan($key->orang) as $k)
                                                    <div class="col-3 mb-1 px-1">
                                                        {!! kingdom_orangpoto($k->orang->photo,$k->orang->id,'rounded-circle') !!}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @php
                                            $no++
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                    @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
    </x-slot>
</x-singel-layout>
