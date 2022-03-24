<x-mazer-layout title="CHATOMZ - Daftar Orang">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Orang" active="Daftar Orang"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ url('/orang')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Kembali ke daftar orang</a>
                                <span class="float-end">{{  count($orang) }} Orang</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{  url('/lihat/orangpoto') }}" method="get">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="" class="small">Jenis Kelamin</label>
                                                        <select name="kelamin" id="" class="form-control" onchange="this.form.submit()">
                                                            <option value="semua" @if ($sesi['kelamin'] == 'semua')
                                                                selected
                                                            @endif>Semua</option>
                                                            <option value="laki-laki"  @if ($sesi['kelamin'] == 'laki-laki')
                                                            selected
                                                            @endif>Laki - laki</option>
                                                                <option value="perempuan"  @if ($sesi['kelamin'] == 'perempuan')
                                                                selected
                                                            @endif>Perempuan</option>
                                                                <option value="lainnya"  @if ($sesi['kelamin'] == 'lainnya')
                                                                selected
                                                            @endif>Lainnya</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="" class="small">Status Perkawinan</label>
                                                        <select name="perkawinan" id="" class="form-control" onchange="this.form.submit()">
                                                            <option value="semua" @if ($sesi['perkawinan'] == 'semua')
                                                                selected
                                                            @endif >Semua</option>
                                                            <option value="belum" @if ($sesi['perkawinan'] == 'belum')
                                                                selected
                                                            @endif >Belum Kawin</option>
                                                            <option value="sudah" @if ($sesi['perkawinan'] == 'sudah')
                                                                selected
                                                            @endif>Sudah Kawin</option>
                                                            <option value="pernah" @if ($sesi['perkawinan'] == 'pernah')
                                                                selected
                                                            @endif>Pernah Kawin</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="" class="small">Usia Awal</label>
                                                        <select name="usia_awal" id="" class="form-control" onchange="this.form.submit()">
                                                        @for ($i = 0; $i < 100; $i++)
                                                            <option value="{{ $i }}"  @if ($sesi['usia1'] == $i)
                                                            selected
                                                        @endif>{{ $i }} Tahun</option>
                                                        @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="" class="small">Usia Akhir</label>
                                                        <select name="usia_akhir" id="" class="form-control" onchange="this.form.submit()">
                                                        @for ($i = 0; $i <= 100; $i++)
                                                            <option value="{{ $i }}"  @if ($sesi['usia2'] == $i)
                                                            selected
                                                        @endif>{{ $i }} Tahun</option>
                                                        @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="" class="small">Status Kematian</label>
                                                        <select name="kematian" id="" class="form-control" onchange="this.form.submit()">
                                                            <option value="semua" @if ($sesi['kematian'] == 'semua')
                                                                selected
                                                            @endif >Semua</option>
                                                            <option value="" @if ($sesi['kematian'] == NULL)
                                                                selected
                                                            @endif>Masih Hidup</option>
                                                            <option value="alm" @if ($sesi['kematian'] == 'alm')
                                                                selected
                                                            @endif>Meninggal</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                        @forelse ($orang as $item)
                                            <div class="col-md-2">
                                                <div class="card w-100">
                                                    <a href="{{ url('/orang/'.Crypt::encryptString($item->id))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img-top" alt="..."></a>
                                                    <div class="card-body p-1 text-center">
                                                    <small class="text-capitalize">{{ $item->first_name.' '.$item->last_name}}</small>
                                                    {{-- <p class="card-text">{{ $item->home_address}}</p> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        <div class="col-md-12">
                                            <div class="alert alert-warning text-center">
                                                tidak ada data
                                            </div>
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
