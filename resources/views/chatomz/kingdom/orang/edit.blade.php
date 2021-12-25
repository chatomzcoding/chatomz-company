@section('title')
    CHATOMZ - Edit Orang
@endsection

<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Orang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('orang')}}">Daftar Orang</a></li>
                <li class="breadcrumb-item"><a href="{{ url('orang/'.Crypt::encryptString($orang->id))}}">{{ $orang->first_name.' '.$orang->last_name}}</a></li>
                <li class="breadcrumb-item active">Edit</li>
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
                <a href="{{ url('/orang/'.Crypt::encryptString($orang->id))}}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-angle-left"></i> Kembali</a>
                <a href="{{ url('/orang')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Kembali ke daftar orang</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <form method="post" action="{{ url('/orang/'.$orang->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Nama Awal</label>
                                    <input type="text" class="form-control col-md-8" name="first_name" id="inlineinput" value="{{ $orang->first_name}}" required>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Nama Akhir</label>
                                    <input type="text" class="form-control col-md-8" name="last_name" id="inlineinput" value="{{ $orang->last_name}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Nama Panggilan</label>
                                    <input type="text" class="form-control col-md-8" name="nick_name" id="inlineinput"  value="{{ $orang->nick_name}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Alamat Rumah</label>
                                    <textarea name="home_address" id="" cols="30" rows="3" class="form-control col-md-8">{{ $orang->home_address}}</textarea>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Alamat Sekarang</label>
                                    <textarea name="current_address" id="" cols="30" rows="3" class="form-control col-md-8">{{ $orang->current_address}}</textarea>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Tempat Lahir</label>
                                    <input type="text" name="place_birth" class="form-control col-md-8" id="inlineinput" value="{{ $orang->place_birth}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Tanggal Lahir</label>
                                    <input type="date" name="date_birth" class="form-control col-md-8" id="inlineinput" value="{{ $orang->date_birth}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Pekerjaan</label>
                                    <input type="text" name="job_status" class="form-control col-md-8" value="{{ $orang->job_status}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Jenis Kelamin</label>
                                    <select name="gender" id="" class="form-control col-md-8">
                                        <option value="laki-laki" @if ($orang->gender == 'laki-laki')
                                            selected
                                        @endif>Laki - laki</option>
                                        <option value="perempuan" @if ($orang->gender == 'perempuan')
                                            selected
                                        @endif>Perempuan</option>
                                        <option value="lainnya" @if ($orang->gender == 'lainnya')
                                            selected
                                        @endif>Lainnya</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Kebangsaan</label>
                                    <select name="nasionality" id="" class="form-control col-md-8">
                                        @foreach (countryname() as $item)
                                        <option value="{{ $item }}" @if ($orang->nasionality == $item)
                                            selected
                                        @endif>{{ $item }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Agama</label>
                                    <select name="religion" id="" class="form-control col-md-8">
                                        @foreach (kingdom_agama() as $item)
                                        <option value="{{ $item}}" @if ($item == $orang->religion)
                                            selected
                                        @endif>{{ $item}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Golongan Darah</label>
                                    <select name="blood_type" id="" class="form-control col-md-8">
                                        @foreach (kingdom_goldar() as $item)
                                        <option value="{{ $item}}" @if ($item == $orang->blood_type)
                                            selected
                                        @endif>{{ $item}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Status Perkawinan</label>
                                    <select name="marital_status" id="" class="form-control col-md-8">
                                        <option value="belum" @if ($orang->marital_status == 'belum')
                                            selected
                                        @endif >Belum Kawin</option>
                                        <option value="sudah" @if ($orang->marital_status == 'sudah')
                                            selected
                                        @endif>Sudah Kawin</option>
                                        <option value="pernah" @if ($orang->marital_status == 'pernah')
                                            selected
                                        @endif>Pernah Kawin</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Grup Status</label>
                                    <select name="status_group" id="" class="form-control col-md-8">
                                        <option value="available" @if ($orang->status_group == 'available')
                                            selected
                                        @endif>Tersedia</option>
                                        <option value="full"  @if ($orang->status_group == 'full')
                                            selected
                                        @endif>Ditutup</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Status Kematian</label>
                                    <select name="death" id="" class="form-control col-md-8">
                                        <option value="" @if ($orang->death == NULL)
                                            selected
                                        @endif>Masih Hidup</option>
                                        <option value="alm" @if ($orang->death == 'alm')
                                            selected
                                        @endif>Meninggal</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Catatan</label>
                                    <input type="text" name="note" class="form-control col-md-8" id="inlineinput" value="{{ $orang->note}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Photo</label>
                                <div class="col-md-8">
                                    <input type="file" name="photo" class="form-control">
                                    <span class="text-danger">input jika ingin mengubah photo</span>
                                </div>
                            </div>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
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
