@section('title')
    Company - Gadget Handphone
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Tambah Data Gadget Handphone</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('gadgethandphone')}}">Data Gadget Handphone</a></li>
                <li class="breadcrumb-item active">Tambah Gadget Handphone</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                <a href="{{ url('gadgethandphone') }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-plus"></i> Kembali </a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  {{-- <section class="text-right my-2">
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Data</button>
                  </section> --}}
                   <div class="row">
                       <div class="col-md-12">
                                <form action="{{ url('gadgethandphone') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                <div class="form-group row">
                                    <label for="" class="col-md-4">Nama Handphone</label>
                                    <input type="text" name="nama_gadget" id="nama_gadget" class="form-control col-md-8" value="{{ old('nama_gadget')}}" required>
                               </div>
                               <div class="form-group row">
                                 <label for="" class="col-md-4">Keterangan</label>
                                 <textarea name="keterangan" id="" cols="30" rows="4" class="col-md-8 form-control">{{ old('keterangan') }}</textarea>
                                </div>
                               <div class="form-group row">
                                   <label for="" class="col-md-4">Merk</label>
                                   <select name="merk_id" id="" class="col-md-8 form-control">
                                       @foreach ($merk as $item)
                                       <option value="{{ $item->id }}">{{ strtoupper($item->nama) }}</option>
                                       @endforeach
                                   </select>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="" class="col-md-4">Jaringan</label>
                                    <input type="text" name="network" id="network" class="form-control col-md-8" value="{{ old('network')}}">
                               </div>
                                <div class="form-group row">
                                  <label for="" class="col-md-4">Gambar</label>
                                     <input type="file" name="gambar" id="gambar" class="form-control col-md-8" required>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-md-6 col-lg-4">
                                    <h5>Data Kamera</h5>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Kamera Utama</label>
                                      <input type="text" name="kamera_main" id="kamera_main" class="form-control col-md-8" value="{{ old('kamera_main')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Kamera UltraWide</label>
                                      <input type="text" name="kamera_ultrawide" id="kamera_ultrawide" class="form-control col-md-8" value="{{ old('kamera_ultrawide')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Kamera Macro</label>
                                      <input type="text" name="kamera_macro" id="kamera_macro" class="form-control col-md-8" value="{{ old('kamera_macro')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Kamera Depth</label>
                                      <input type="text" name="kamera_depth" id="kamera_depth" class="form-control col-md-8" value="{{ old('kamera_depth')}}">
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-lg-4">
                                    <h5>Data Platform</h5>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Sistem Operasi</label>
                                      <input type="text" name="platform_os" id="platform_os" class="form-control col-md-8" value="{{ old('platform_os')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Chipset</label>
                                      <input type="text" name="platform_chipset" id="platform_chipset" class="form-control col-md-8" value="{{ old('platform_chipset')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">CPU</label>
                                      <input type="text" name="platform_cpu" id="platform_cpu" class="form-control col-md-8" value="{{ old('platform_cpu')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">GPU</label>
                                      <input type="text" name="platform_gpu" id="platform_gpu" class="form-control col-md-8" value="{{ old('platform_gpu')}}">
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-lg-4">
                                    <h5>Data Layar</h5>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Type</label>
                                      <input type="text" name="layar_type" id="layar_type" class="form-control col-md-8" value="{{ old('layar_type')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Ukuran</label>
                                      <input type="text" name="layar_size" id="layar_size" class="form-control col-md-8" value="{{ old('layar_size')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Resolusi</label>
                                      <input type="text" name="layar_resolusi" id="layar_resolusi" class="form-control col-md-8" value="{{ old('layar_resolusi')}}">
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-lg-4">
                                    <h5>Data Baterai</h5>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Type</label>
                                      <input type="text" name="baterai_type" id="baterai_type" class="form-control col-md-8" value="{{ old('baterai_type')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Charger</label>
                                      <input type="text" name="baterai_charging" id="baterai_charging" class="form-control col-md-8" value="{{ old('baterai_charging')}}">
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-lg-4">
                                    <h5>Data Body</h5>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Dimensi</label>
                                      <input type="text" name="body_dimensi" id="body_dimensi" class="form-control col-md-8" value="{{ old('body_dimensi')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Berat</label>
                                      <input type="text" name="body_berat" id="body_berat" class="form-control col-md-8" value="{{ old('body_berat')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">SIM</label>
                                      <input type="text" name="body_sim" id="body_sim" class="form-control col-md-8" value="{{ old('body_sim')}}">
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-lg-4">
                                    <h5>Data Memori</h5>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">Internal</label>
                                      <input type="text" name="memori_internal" id="memori_internal" class="form-control col-md-8" value="{{ old('memori_internal')}}">
                                    </div>
                                    <div class="form-group row">
                                      <label for="" class="col-md-4">RAM</label>
                                      <input type="text" name="memori_ram" id="memori_ram" class="form-control col-md-8" value="{{ old('memori_ram')}}">
                                    </div>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> SIMPAN</button>
                            </form>
                            </div>
                   </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
