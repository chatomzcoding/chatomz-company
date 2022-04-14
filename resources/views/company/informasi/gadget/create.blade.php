<x-mazer-layout title="Company - Tambah Informasi Sub">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Tambah Informasi Gadget Baru" active="Tambah Data">
                <li class="breadcrumb-item"><a href="{{ url('informasi/'.$informasi->id)}}">Daftar Informasi Gadget</a></li>
            </x-header>
        </div>
        <div class="section">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <a href="{{ url('informasi/'.$informasi->id) }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i> Kembali </a>
                  </div>
                  <div class="card-body">
                       <div class="row">
                           <div class="col-md-12">
                                    <form action="{{ url('informasisub') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="sesi" value="gadget">
                                        <input type="hidden" name="informasi_id" value="{{ $informasi->id }}">
                                    <div class="form-group">
                                        <label for="">Nama Gadget {!! ireq() !!}</label>
                                        <input type="text" name="nama_sub" id="nama_sub" class="form-control" value="{{ old('nama_sub')}}" required>
                                   </div>
                                   <div class="form-group">
                                     <label for="">Keterangan</label>
                                     <textarea name="tentang" id="" cols="30" rows="4" class="form-control">{{ old('tentang') }}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Jaringan</label>
                                        <input type="text" name="network" id="network" class="form-control" value="{{ old('network')}}">
                                   </div>
                                    <div class="form-group">
                                      <label for="">Gambar {!! ireq() !!}</label>
                                         <input type="file" name="gambar_sub" id="gambar" class="form-control" required>
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Kamera</h5>
                                        <div class="form-group">
                                          <label for="">Kamera Utama</label>
                                          <input type="text" name="main" id="main" class="form-control" value="{{ old('main')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Kamera UltraWide</label>
                                          <input type="text" name="ultrawide" id="ultrawide" class="form-control" value="{{ old('ultrawide')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Kamera Macro</label>
                                          <input type="text" name="macro" id="macro" class="form-control" value="{{ old('macro')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Kamera Depth</label>
                                          <input type="text" name="depth" id="depth" class="form-control" value="{{ old('depth')}}">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Platform</h5>
                                        <div class="form-group">
                                          <label for="">Sistem Operasi</label>
                                          <input type="text" name="os" id="os" class="form-control" value="{{ old('os')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Chipset</label>
                                          <input type="text" name="chipset" id="chipset" class="form-control" value="{{ old('chipset')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">CPU</label>
                                          <input type="text" name="cpu" id="cpu" class="form-control" value="{{ old('cpu')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">GPU</label>
                                          <input type="text" name="gpu" id="gpu" class="form-control" value="{{ old('gpu')}}">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Layar</h5>
                                        <div class="form-group">
                                          <label for="">Type</label>
                                          <input type="text" name="type_layar" id="type_layar" class="form-control" value="{{ old('type_layar')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Ukuran</label>
                                          <input type="text" name="size" id="size" class="form-control" value="{{ old('size')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Resolusi</label>
                                          <input type="text" name="resolusi" id="resolusi" class="form-control" value="{{ old('resolusi')}}">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Baterai</h5>
                                        <div class="form-group">
                                          <label for="">Type</label>
                                          <input type="text" name="type_baterai" id="type_baterai" class="form-control" value="{{ old('type_baterai')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Charger</label>
                                          <input type="text" name="charging" id="charging" class="form-control" value="{{ old('charging')}}">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Body</h5>
                                        <div class="form-group">
                                          <label for="">Dimensi</label>
                                          <input type="text" name="dimensi" id="dimensi" class="form-control" value="{{ old('dimensi')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Berat</label>
                                          <input type="text" name="berat" id="berat" class="form-control" value="{{ old('berat')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">SIM</label>
                                          <input type="text" name="sim" id="sim" class="form-control" value="{{ old('sim')}}">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Memori</h5>
                                        <div class="form-group">
                                          <label for="">Internal</label>
                                          <input type="text" name="internal" id="internal" class="form-control" value="{{ old('internal')}}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">RAM</label>
                                          <input type="text" name="ram" id="ram" class="form-control" value="{{ old('ram')}}">
                                        </div>
                                      </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm float-end"><i class="fas fa-save"></i> SIMPAN</button>
                                </form>
                                </div>
                       </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </x-slot>
</x-mazer-layout>
