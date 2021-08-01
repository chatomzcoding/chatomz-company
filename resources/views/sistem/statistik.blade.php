@section('title')
    CHATOMZ - Data Statistik
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Statistik</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Statistik Data</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Total Orang</span>
                  <span class="info-box-number">{{ DbChatomz::countData('orang') }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-heart"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Total Keluarga</span>
                  <span class="info-box-number">{{ DbChatomz::countData('keluarga') }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-id-card"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Total Grup</span>
                  <span class="info-box-number">{{ DbChatomz::countData('grup') }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">93,139</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>

          <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Orang Baru Ditambahkan</h3>
  
                      <div class="card-tools">
                        <span class="badge badge-danger">8 Orang</span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <ul class="users-list clearfix">
                          @foreach ($data['orangbaru'] as $item)
                            <li>
                                <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" alt="User Image">
                                <a class="users-list-name" href="{{ url('/orang/'.Crypt::encryptString($item->id)) }}">{{ fullname($item) }}</a>
                                <span class="users-list-date">{{ $item->gender }}</span>
                            </li>
                          @endforeach
                      </ul>
                      <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                      <a href="{{ url('/orang') }}">Lihat Semua Data</a>
                    </div>
                    <!-- /.card-footer -->
                  </div>
            </div>
          </div>
    </div>

</x-app-layout>
