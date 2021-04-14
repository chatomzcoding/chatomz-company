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
                <a href="{{ url('/orang/'.Crypt::encryptString($orang->id))}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Kembali ke detail</a>
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
                                <label for="inlineinput" class="col-md-4 col-form-label">First Name</label>
                                    <input type="text" class="form-control col-md-8" name="first_name" id="inlineinput" value="{{ $orang->first_name}}" required>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Last Name</label>
                                    <input type="text" class="form-control col-md-8" name="last_name" id="inlineinput" value="{{ $orang->last_name}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Nick Name</label>
                                    <input type="text" class="form-control col-md-8" name="nick_name" id="inlineinput"  value="{{ $orang->nick_name}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Home Address</label>
                                    <textarea name="home_address" id="" cols="30" rows="3" class="form-control col-md-8">{{ $orang->home_address}}</textarea>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Current Address</label>
                                    <textarea name="current_address" id="" cols="30" rows="3" class="form-control col-md-8">{{ $orang->current_address}}</textarea>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Place Birth</label>
                                    <input type="text" name="place_birth" class="form-control col-md-8" id="inlineinput" value="{{ $orang->place_birth}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Date Birth</label>
                                    <input type="date" name="date_birth" class="form-control col-md-8" id="inlineinput" value="{{ $orang->date_birth}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Job Status</label>
                                    <input type="text" name="job_status" class="form-control col-md-8" value="{{ $orang->job_status}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Gender</label>
                                    <select name="gender" id="" class="form-control col-md-8">
                                        <option value="male" @if ($orang->gender == 'male')
                                            selected
                                        @endif>Male</option>
                                        <option value="female" @if ($orang->gender == 'female')
                                            selected
                                        @endif>Female</option>
                                        <option value="other" @if ($orang->gender == 'other')
                                            selected
                                        @endif>Other</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Nasionality</label>
                                    <select name="nasionality" id="" class="form-control col-md-8">
                                        @foreach (countryname() as $item)
                                        <option value="{{ $item }}" @if ($orang->nasionality == $item)
                                            selected
                                        @endif>{{ $item }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Religion</label>
                                    <select name="religion" id="" class="form-control col-md-8">
                                        @foreach (kingdom_agama() as $item)
                                        <option value="{{ $item}}" @if ($item == $orang->religion)
                                            selected
                                        @endif>{{ $item}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Blood Type</label>
                                    <select name="blood_type" id="" class="form-control col-md-8">
                                        @foreach (kingdom_goldar() as $item)
                                        <option value="{{ $item}}" @if ($item == $orang->blood_type)
                                            selected
                                        @endif>{{ $item}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Marital Status</label>
                                    <select name="marital_status" id="" class="form-control col-md-8">
                                        <option value="single" @if ($orang->marital_status == 'single')
                                            selected
                                        @endif >Single</option>
                                        <option value="married" @if ($orang->marital_status == 'married')
                                            selected
                                        @endif>Married</option>
                                        <option value="ever been married" @if ($orang->marital_status == 'ever been married')
                                            selected
                                        @endif>Ever Been married</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Group Status</label>
                                    <select name="status_group" id="" class="form-control col-md-8">
                                        <option value="available" @if ($orang->status_group == 'available')
                                            selected
                                        @endif>Available</option>
                                        <option value="full"  @if ($orang->status_group == 'full')
                                            selected
                                        @endif>Full</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Status Kematian</label>
                                    <select name="death" id="" class="form-control col-md-8">
                                        <option value="" @if ($orang->death == NULL)
                                            selected
                                        @endif>Ada</option>
                                        <option value="alm" @if ($orang->death == 'alm')
                                            selected
                                        @endif>Almarhum</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Note</label>
                                    <input type="text" name="note" class="form-control col-md-8" id="inlineinput" value="{{ $orang->note}}">
                            </div>
                            <div class="form-group row">
                                <label for="inlineinput" class="col-md-4 col-form-label">Photo</label>
                                    <input type="file" name="photo"> input jika ingin mengubah photo
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