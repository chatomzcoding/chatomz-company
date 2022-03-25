<x-mazer-layout title="Company - Usaha" alert="TRUE" select="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Mitra Usaha" p="daftar lapak pengusaha" active="Daftar Mitra Usaha">
            </x-header>
            <section class="section">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Mitra Usaha</a>
                      </div>
                      <div class="card-body">
                         <div class="row">
                             @forelse ($usaha as $item)
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="card border">
                                        <div class="card-content">
                                            @if (is_null($item->gambar_lokasi))
                                                <img src="{{ asset('img/usaha.png')}}" class="card-img-top img-fluid" alt="gambar">
                                                @else
                                                <img src="{{ asset('img/company/bisnis/usaha/'.$item->gambar_lokasi)}}" class="card-img-top img-fluid" alt="gambar">
                                            @endif
                                            <div class="card-body py-2">
                                                <h5 class="card-title">{{ $item->nama_usaha }}</h5>
                                                <i class="bi-person"></i> <span>Owner <a href="{{ url('orang/'.Crypt::encryptString($item->orang->id)) }}">{{ fullname($item->orang)}}</a></span>
                                                <p class="card-text fst-italic">
                                                   <i class="bi-geo-alt"></i> {{ $item->lokasi }}
                                                </p>
                                                <form id="data-{{ $item->id }}" action="{{url('/usaha/'.$item->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <hr>
                                                <div class="d-flex justify-content-center">
                                                    <section class="p-1">
                                                        <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-icon btn-round btn-outline-danger pop-info" title="hapus orang"><i class="bi-trash"></i></button>
                                                    </section>
                                                    <section class="p-1">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#ubah" class="btn btn-icon btn-round btn-outline-success pop-info" title="Edit Orang"  data-id="{{ $item->id }}" data-nama_usaha="{{ $item->nama_usaha }}" data-lokasi="{{ $item->lokasi }}" data-bidang="{{ $item->bidang }}" data-orang_id="{{ $item->orang_id }}" data-status="{{ $item->status }}"><i class="bi-pencil"></i></a>
                                                    </section>
                                                    <section class="p-1">
                                                        <a href="{{ url('usaha/'.Crypt::encryptString($item->id)) }}" class="btn btn-icon btn-round btn-outline-primary pop-info" title="tambah lini masa">
                                                                <i class="bi-file-text"></i></a>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             @empty
                                <div class="col text-center">
                                    <small>belum ada data</small>
                                </div>                                 
                             @endforelse
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
        </div>
        <x-modalsimpan judul="Tambah Mitra Usaha Baru" link="usaha">
            <section>
                <label>Nama Usaha {!! ireq() !!} </label>
                <div class="form-group">
                    <input type="text" name="nama_usaha" placeholder="Masukkan nama usaha" class="form-control" value="{{ old('nama_usaha') }}" required>
                </div>
                <label>Lokasi {!! ireq() !!} </label>
                <div class="form-group">
                    <input type="text" name="lokasi" placeholder="Masukkan lokasi usaha" class="form-control" value="{{ old('lokasi') }}" required>
                </div>
                <label>Owner / Pemilik : </label>
                <div class="form-group">
                    <select name="orang_id" id="orang_id" class="form-control select2bs4" data-width="100%">
                        @foreach ($orang as $item)
                            <option value="{{ $item->id }}">{{ fullname($item) }}</option>
                        @endforeach
                    </select>
                </div>
                <label>bidang usaha (#bidang) {!! ireq() !!} </label>
                <div class="form-group">
                    <textarea name="bidang" id="bidang" cols="30" rows="3" class="form-control" required>{{ old('bidang') }}</textarea>
                </div>
                <label>Poto Lokasi : </label>
                <div class="form-group">
                    <input type="file" name="gambar_lokasi" class="form-control">
                </div>
            </section>
        </x-modalsimpan>

        <x-modalubah judul="Ubah Data Usaha" link="usaha">
            <section>
                <label>Nama Usaha {!! ireq() !!} </label>
                <div class="form-group">
                    <input type="text" name="nama_usaha" id="nama_usaha" placeholder="Masukkan nama usaha" class="form-control" value="{{ old('nama_usaha') }}" required>
                </div>
                <label>Lokasi {!! ireq() !!} </label>
                <div class="form-group">
                    <input type="text" name="lokasi" id="lokasi" placeholder="Masukkan lokasi usaha" class="form-control" value="{{ old('lokasi') }}" required>
                </div>
                <label>Owner / Pemilik : </label>
                <div class="form-group">
                    <select name="orang_id" id="orang_id" class="form-control select2bs4" data-width="100%">
                        @foreach ($orang as $item)
                            <option value="{{ $item->id }}">{{ fullname($item) }}</option>
                        @endforeach
                    </select>
                </div>
                <label>Status Usaha : </label>
                <div class="form-group">
                    <select name="status" id="status" class="form-control" data-width="100%">
                            <option value="buka">BUKA</option>
                            <option value="tutup">TUTUP</option>
                            <option value="tutup sementar">TUTUP SEMENTARA</option>
                    </select>
                </div>
                <label>bidang usaha (#bidang) {!! ireq() !!} </label>
                <div class="form-group">
                    <textarea name="bidang" id="bidang" cols="30" rows="3" class="form-control" required>{{ old('bidang') }}</textarea>
                </div>
                <label>Poto Lokasi : </label>
                <div class="form-group">
                    <input type="file" name="gambar_lokasi" class="form-control">
                </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_usaha = button.data('nama_usaha')
                var lokasi = button.data('lokasi')
                var bidang = button.data('bidang')
                var orang_id = button.data('orang_id')
                var status = button.data('status')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_usaha').val(nama_usaha);
                modal.find('.modal-body #lokasi').val(lokasi);
                modal.find('.modal-body #bidang').val(bidang);
                modal.find('.modal-body #orang_id').val(orang_id);
                modal.find('.modal-body #status').val(status);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
