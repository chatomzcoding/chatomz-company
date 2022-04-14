<x-mazer-layout title="Company - Tambah Informasi Sub">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Tambah Informasi Gadget Baru" active="Tambah Data">
                <li class="breadcrumb-item"><a href="{{ url('informasi/'.$informasisub->informasi->id)}}">Daftar Informasi Gadget</a></li>
            </x-header>
        </div>
        <div class="section">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <a href="{{ url('informasi/'.$informasisub->informasi->id) }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i> Kembali </a>
                  </div>
                  <div class="card-body">
                       <div class="row">
                           <div class="col-md-12">
                                @php
                                    $detail = json_decode($informasisub->detail_sub);
                                @endphp
                                    <form action="{{ route('informasisub.update','test') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="sesi" value="gadget">
                                        <input type="hidden" name="id" value="{{ $informasisub->id }}">
                                    <div class="form-group">
                                        <label for="">Nama Gadget {!! ireq() !!}</label>
                                        <input type="text" name="nama_sub" id="nama_sub" class="form-control" value="{{ $informasisub->nama_sub }}" required>
                                   </div>
                                   <div class="form-group">
                                     <label for="">Keterangan</label>
                                     <textarea name="tentang" id="" cols="30" rows="4" class="form-control">{{ $detail->tentang }}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Jaringan</label>
                                        <input type="text" name="network" id="network" class="form-control" value="{{ $detail->network }}">
                                   </div>
                                    <div class="form-group">
                                      <label for="">Gambar {!! ireq() !!}</label>
                                         <input type="file" name="gambar_sub" id="gambar" class="form-control">
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Kamera</h5>
                                        <div class="form-group">
                                          <label for="">Kamera Utama</label>
                                          <input type="text" name="main" class="form-control" value="{{ $detail->kamera->main }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Kamera UltraWide</label>
                                          <input type="text" name="ultrawide" id="ultrawide" class="form-control" value="{{ $detail->kamera->ultrawide }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Kamera Macro</label>
                                          <input type="text" name="macro" id="macro" class="form-control" value="{{ $detail->kamera->macro }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Kamera Depth</label>
                                          <input type="text" name="depth" id="depth" class="form-control" value="{{ $detail->kamera->depth }}">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Platform</h5>
                                        <div class="form-group">
                                          <label for="">Sistem Operasi</label>
                                          <input type="text" name="os" id="os" class="form-control" value="{{ $detail->platform->os }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Chipset</label>
                                          <input type="text" name="chipset" id="chipset" class="form-control" value="{{ $detail->platform->chipset }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">CPU</label>
                                          <input type="text" name="cpu" id="cpu" class="form-control" value="{{ $detail->platform->cpu }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">GPU</label>
                                          <input type="text" name="gpu" id="gpu" class="form-control" value="{{ $detail->platform->gpu }}">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Layar</h5>
                                        <div class="form-group">
                                          <label for="">Type</label>
                                          <input type="text" name="type_layar" id="type_layar" class="form-control" value="{{ $detail->layar->type }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Ukuran</label>
                                          <input type="text" name="size" id="size" class="form-control" value="{{ $detail->layar->size }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Resolusi</label>
                                          <input type="text" name="resolusi" id="resolusi" class="form-control" value="{{ $detail->layar->resolusi }}">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Baterai</h5>
                                        <div class="form-group">
                                          <label for="">Type</label>
                                          <input type="text" name="type_baterai" id="type_baterai" class="form-control" value="{{ $detail->baterai->type }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Charger</label>
                                          <input type="text" name="charging" id="charging" class="form-control" value="{{ $detail->baterai->charging }}">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Body</h5>
                                        <div class="form-group">
                                          <label for="">Dimensi</label>
                                          <input type="text" name="dimensi" id="dimensi" class="form-control" value="{{ $detail->body->dimensi }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">Berat</label>
                                          <input type="text" name="berat" id="berat" class="form-control" value="{{ $detail->body->berat }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">SIM</label>
                                          <input type="text" name="sim" id="sim" class="form-control" value="{{ $detail->body->sim }}">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-lg-4">
                                        <h5>Data Memori</h5>
                                        <div class="form-group">
                                          <label for="">Internal</label>
                                          <input type="text" name="internal" id="internal" class="form-control" value="{{ $detail->memori->internal }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="">RAM</label>
                                          <input type="text" name="ram" id="ram" class="form-control" value="{{ $detail->memori->ram }}">
                                        </div>
                                      </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm float-end"><i class="bi-pen"></i> SIMPAN PERUBAHAN</button>
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
