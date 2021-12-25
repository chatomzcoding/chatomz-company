@section('title')
    CHATOMZ - Get Data
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Api Mahasiswa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Get Data</li>
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
                <a href="{{ url('orang')}}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-angle-left"></i> Kembali</a>
              </div>
              <div class="card-body">
                @foreach ($result as $item)
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{  $item['FotoUrl']}}" alt="" class="img-fluid">

                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>NPM</th>
                                        <td>{{ $item['MhswID']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $item['Nama']}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Tanggal lahir</th>
                                        <td>{{ $item['TanggalLahir']}}</td>
                                    </tr>
                                        <th>Kelamin</th>
                                        <td>{{ $item['Kelamin']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $item['Alamat']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Handphone</th>
                                        <td>{{ $item['Handphone']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $item['StatusMhswID']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
             @endforeach
              </div>
            </div>
          </div>
        </div>
    </div>

</x-app-layout>
