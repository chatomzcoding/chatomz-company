@section('title')
    CHATOMZ - Edit Kontak
@endsection

<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Kontak</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('orang')}}">Daftar Orang</a></li>
                <li class="breadcrumb-item"><a href="{{ url('orang/'.Crypt::encryptString($orang->id))}}">{{ $orang->first_name.' '.$orang->last_name}}</a></li>
                <li class="breadcrumb-item active">Edit Kontak</li>
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
                  <form method="post" action="{{ url('/kontak/'.$kontak->id)}}">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">No Telepon Seluler</label>
                                <input type="text" class="form-control col-md-8" name="no_hp" placeholder="input number phone celluler" value="{{ $kontak->no_hp }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">No Telepon Rumah</label>
                                <input type="text" class="form-control col-md-8" name="no_tel" placeholder="input number phone home" value="{{ $kontak->no_tel }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">No Whatsapp</label>
                                <input type="text" class="form-control col-md-8" name="no_wa" placeholder="input number whatsapp" value="{{ $kontak->no_wa }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">No Telepon Kantor</label>
                                <input type="text" class="form-control col-md-8" name="no_office" placeholder="input number office phone" value="{{ $kontak->no_office }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Alamat E-mail</label>
                                <input type="text" class="form-control col-md-8" name="email" placeholder="input email address" value="{{ $kontak->email }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Alamat E-mail Kantor</label>
                                <input type="text" class="form-control col-md-8" name="office_email" placeholder="input email office address" value="{{ $kontak->office_email }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Link Facebook</label>
                                <input type="text" class="form-control col-md-8" name="fb" placeholder="input link facebook" value="{{ $kontak->fb }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Link Twitter</label>
                                <input type="text" class="form-control col-md-8" name="tw" placeholder="input link twitter" value="{{ $kontak->tw }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Link Instagram</label>
                                <input type="text" class="form-control col-md-8" name="ig" placeholder="input link instagram" value="{{ $kontak->ig }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Website</label>
                                <input type="text" class="form-control col-md-8" name="web" placeholder="input website" value="{{ $kontak->web }}">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2">Line</label>
                                <input type="text" class="form-control col-md-8" name="line" placeholder="input account line" value="{{ $kontak->line }}">
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
