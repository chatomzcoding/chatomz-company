@section('title')
    DASHBOARD
@endsection
<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>
    <div class="container-fluid">
      <div class="row">
        {{-- informasi update aplikasi --}}
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $total['orang']}}</h3>

              <p>Orang</p>
            </div>
            <div class="icon">
              <i class="fas fa-user"></i>
            </div>
            <a href="{{ url('/orang')}}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $total['grup']}}</h3>

              <p>Grup</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
              {{-- <i class="ion ion-stats-bars"></i> --}}
            </div>
            <a href="{{ url('/grup')}}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $total['keluarga']}}</h3>

              <p>Keluarga</p>
            </div>
            <div class="icon">
              <i class="fas fa-house-user"></i>
            </div>
            <a href="{{ url('/keluarga')}}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-indigo">
            <div class="inner">
              <h3>{{ $total['jejak']}}</h3>

              <p>Jejak</p>
            </div>
            <div class="icon">
              <i class="fas fa-shoe-prints"></i>
            </div>
            <a href="{{ url('/jejak')}}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      {{-- info orang --}}
      @include('chatomz.admin.dashboard.infoorang')
    </div><!-- /.container-fluid -->
</x-app-layout>
