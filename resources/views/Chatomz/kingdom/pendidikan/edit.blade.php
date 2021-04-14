@section('title')
    CHATOMZ - Edit Pendidikan
@endsection

<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data pendidikan-</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('orang')}}">Daftar Orang</a></li>
                <li class="breadcrumb-item"><a href="{{ url('orang/'.Crypt::encryptString($orang->id))}}">{{ $orang->first_name.' '.$orang->last_name}}</a></li>
                <li class="breadcrumb-item active">Edit Pendidikan</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>

    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <a href="{{ url('/orang/'.Crypt::encryptString($orang->id))}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-angle-left"></i> Kembali ke detail</a>
                <a href="{{ url('/orang')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-angle-left"></i> Kembali ke daftar orang</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <form method="post" action="{{ url('/pendidikan/'.$pendidikan->id)}}">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">TK/TPA</label>
                                <input type="text" class="form-control col-md-8" name="tk" value="{{ $pendidikan->tk }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">SD</label>
                                <input type="text" class="form-control col-md-8" name="sd"  value="{{ $pendidikan->sd }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">SMP/MTS</label>
                                <input type="text" class="form-control col-md-8" name="smp"  value="{{ $pendidikan->smp }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">SMA/SMK/MA</label>
                                <input type="text" class="form-control col-md-8" name="sma"  value="{{ $pendidikan->sma }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Jenjang Diploma</label>
                                <input type="text" class="form-control col-md-8" name="d"  value="{{ $pendidikan->d }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Jenjang S1</label>
                                <input type="text" class="form-control col-md-8" name="s1"  value="{{ $pendidikan->s1 }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Jenjang S2</label>
                                <input type="text" class="form-control col-md-8" name="s2"  value="{{ $pendidikan->s2 }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Jenjang S3</label>
                                <input type="text" class="form-control col-md-8" name="s3" value="{{ $pendidikan->s3 }}" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Pesantren</label>
                                <input type="text" class="form-control col-md-8" name="pesantren"  value="{{ $pendidikan->pesantren }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Sekolah Dirumah</label>
                                <input type="text" class="form-control col-md-8" name="homescholl" value="{{ $pendidikan->homescholl }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Boarding Scholl</label>
                                <input type="text" class="form-control col-md-8" name="boardingscholl"  value="{{ $pendidikan->boardingscholl }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Bimbingan Belajar</label>
                                <input type="text" class="form-control col-md-8" name="bimbel"  value="{{ $pendidikan->bimbel }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Kursus</label>
                                <input type="text" class="form-control col-md-8" name="kursus"  value="{{ $pendidikan->kursus }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Informasi Singkat</label>
                                <textarea name="information" id="" cols="30" rows="4" class="form-control col-md-8"> {{ $pendidikan->information }}</textarea>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success btn-sm">PERBAHARUI</button>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
