<x-singel-layout title="CHATOMZ - Data Keluarga {{ $keluarga->nama_keluarga}}" back="orang">
    <x-slot name="content">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                @if (isset($pohon['istri']))
                <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi-plus-circle-fill"></i></a>
            @endif
            <a href="#" data-bs-toggle="modal" data-bs-target="#editkeluarga" class="btn btn-outline-success btn-sm"><i class="bi-pencil"></i></a>
            <a href="{{ url('keluarga/'.Crypt::encryptString($keluarga->id).'?s=silsilah') }}" class="btn btn-outline-info btn-sm"><i class="bi-diagram-3"></i></a>
            <a href="{{ url('keluarga/'.Crypt::encryptString($keluarga->id).'?s=diagram') }}" class="btn btn-outline-dark btn-sm"><i class="bi-diagram-3"></i></a>
                  @if ($keluarga->status_keluarga == 'menikah')
                      <span class="badge bg-info float-end fst-italic">{{ $keluarga->status_keluarga }}</span>
                    @else
                      <span class="badge bg-warning float-end fst-italic">{{ $keluarga->status_keluarga }}</span>
                  @endif
              </div>
                <div class="card-body">
                  {{-- baris kepala keluarga dan istri --}}
                    <div class="row justify-content-center">
                      <div class="col-md-3 pb-0 pt-2">
                          <div class="card bg-primary mb-0">
                              <div class="row no-gutters">
                                <div class="col-4">
                                  <a href="{{ url('/orang/'.Crypt::encryptString($pohon['suami']->id))}}"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($pohon['suami']->photo))}}" class="img-fluid rounded-start" alt="..."></a>
                                </div>
                                <div class="col-8 position-relative">
                                  <div class="card-body p-2 text-white">
                                      <small class="text-capitalize">{{ fullname($pohon['suami'])}} 
                                          {{-- cek keturunan keatas --}}
                                          @if ($pohon['ortusuami'])
                                           <a href="{{ url('keluarga/'.Crypt::encryptString($pohon['ortusuami']->keluarga_id)) }}" class="badge bg-info position-absolute top-0 end-0"><span><i class="bi bi-arrow-up-square"></i></span></a>
                                          @endif
                                      <br> <i>suami</i></small>
                                    </div>
                                </div>
                              </div>
                            </div>
                      </div>
                      @if ($pohon['istri'])
                        <div class="col-md-3 pb-0 pt-2">
                            <div class="card bg-info mb-0">
                                <div class="row no-gutters">
                                <div class="col-4">
                                    <a href="{{ url('/orang/'.Crypt::encryptString($pohon['istri']->orang->id))}}"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($pohon['istri']->orang->photo))}}" class="img-fluid rounded-start" alt="..."></a>
                                </div>
                                <div class="col-8 position-relative">
                                    <div class="card-body p-2 text-white">
                                    <small class="text-capitalize">{{ fullname($pohon['istri']->orang)}}
                                        @if ($pohon['ortuistri'])
                                            <a href="{{ url('keluarga/'.Crypt::encryptString($pohon['ortuistri']->keluarga_id)) }}" class="badge bg-primary position-absolute top-0 end-0"><span><i class="bi bi-arrow-up-square"></i></span></a>
                                        @endif
                                        <br>
                                    <i>istri</i></small>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-md-3 pb-0">
                            <div class="card bg-success mb-0">
                                <div class="row no-gutters">
                                <div class="col-4">
                                    <img src="{{ asset('/img/istri.png')}}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-8">
                                    <div class="card-body p-2 text-white">
                                    <small class="text-capitalize">Belum ada Data
                                    </small><br>
                                    <a href="#" data-bs-target="#tambahistri" data-bs-toggle="modal" class="btn btn-outline-light btn-sm">Tambahkan Istri</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                      @endif
                    </div>
                    {{-- garis keturunan --}}
                    <div class="row justify-content-center">
                        <div class="col-md-3 akar-utama d-none d-sm-block">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-3 akar-kiri d-none d-sm-block">
                        </div>
                        <div class="col-md-3 akar-kanan d-none d-sm-block">
                        </div>
                    </div>
                    @if ($jumlahanak == 0)
                        <div class="row justify-content-center">
                            <div class="col-md-3 bg-secondary text-center small fst-italic text-white d-none d-sm-block">
                                belum ada data
                            </div>
                        </div>
                    @endif
                    <div class="row justify-content-center">
                        @if ($jumlahanak > 0 )
                            @for ($i = 1; $i < $jumlahanak; $i++)
                                @if ($i <= 5)
                                    <div class="col-md-2 akar-anak d-none d-sm-block">

                                    </div>
                                @endif
                            @endfor
                        @endif
                        <div class="col d-block d-sm-none">
                            <hr>
                        </div>
                    </div>

                    <div class="row justify-content-center text-white">
                        @foreach ($keluarga->anakketurunan as $item)
                            <div class="col-md-2 pt-2">
                                <div class="card bg-success mb-1 p-0">
                                    <div class="row">
                                    <div class="col-4 position-relative pe-0">
                                        <span class="position-absolute top-0 start-0 badge bg-info">{{ $loop->iteration }}</span>
                                        <a href="{{ url('/orang/'.Crypt::encryptString($item->orang->id))}}"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->orang->photo))}}" class="img-fluid rounded-start" alt="..."></a>
                                    </div>
                                    <div class="col-8 position-relative">
                                        <small>{!! kingdom_fullname($item->orang) !!}
                                            @php
                                                $keturunan = DbChatomz::cekketurunankeluarga($item->orang->id,$item->orang->gender);
                                            @endphp
                                            @if ($keturunan)
                                                <a href="{{ url('keluarga/'.Crypt::encryptString($keturunan)) }}" class="badge bg-info position-absolute bottom-0 end-0"><span><i class="bi bi-arrow-down-square"></i></span></a>
                                            @endif
                                        </small>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card">
                <div class="card-header p-2">
                  
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if (!is_null($keluarga->no_kk))
                                <strong>No. Kartu Keluarga</strong><br>
                                &nbsp;&nbsp;&nbsp;<small>{{ $keluarga->no_kk }}</small> <br>
                            @endif
                            @if (!is_null($keluarga->tgl_pernikahan))
                                <strong>Tanggal Pernikahan</strong><br>
                                &nbsp;&nbsp;&nbsp;<small>{{ date_indo($keluarga->tgl_pernikahan) }}</small><br>
                            @endif
                            @if (!is_null($keluarga->keterangan))
                                <strong>Keterangan</strong><br>
                                &nbsp;&nbsp;&nbsp;<small>"{{ $keluarga->keterangan }}"</small>
                            @endif
                        </div>
                        <div class="col-md-8 p-1">
                            <div class="table-responsive">
                            <table id="example1" class="table table-borderless">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Aksi</th>
                                        <th>Hubungan</th>
                                        <th>Nama Anggota</th>
                                        <th>Urutan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    @forelse ($keluarga->anakketurunan as $item)
                                    <tr>
                                            <td class="text-center">{{ $loop->iteration}}</td>
                                            <td class="text-center">
                                                <x-aksi :id="$item->id" link="hubungankeluarga">
                                                    <button type="button" data-bs-toggle="modal"   data-urutan="{{ $item->urutan }}" data-keterangan="{{ $item->keterangan }}" data-status="{{ $item->status }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                        <i class="bi-pencil"></i> EDIT
                                                    </button>
                                                </x-aksi>
                                            </td>
                                            <td class="text-center text-uppercase">{{ $item->status}}</td>
                                            <td><a href="{{ url('/orang/'.Crypt::encryptString($item->orang->id))}}">{{ fullname($item->orang) }}</a> </td>
                                            <td class="text-center">{{ $item->urutan}}</td>
                                            <td>{{ $item->keterangan}}</td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="6">tidak ada data</td>
                                        </tr>
                                    @endforelse
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @if (isset($pohon['istri']))
        <x-modalsimpan judul="Tambah Anggota Keluarga" link="hubungankeluarga" tabindex="">
            <input type="hidden" name="keluarga_id" value="{{ $keluarga->id }}">
            <input type="hidden" name="status" value="anak">
            <section class="p-3">
                <div class="form-group">
                <label for="">Nama Anggota Keluarga</label>
                    <select name="orang_id" class="form-select select2bs4">
                        @foreach ($anggotakeluarga as $item)
                            @if ($item->id <> $pohon['suami']->id AND $item->id <> $pohon['istri']->idorang)
                            <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control">
                </div>
            </section>
        </x-modalsimpan>
    @endif
    <x-modalsimpan judul="Tambahkan Istri" link="hubungankeluarga" id="tambahistri" tabindex="">
        <section class="p-3">
            <input type="hidden" name="keluarga_id" value="{{ $keluarga->id }}">
            <input type="hidden" name="status" value="istri">
            <input type="hidden" name="urutan" value="1">
            <div class="form-group">
                <label for="">Nama Istri</label>
                <select name="orang_id" class="form-select select2bs4" data-width="100%">
                    @foreach ($daftaristri as $item)
                    @if (!DbChatomz::cekstatusistri($item->id))
                        <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
           <div class="form-group">
                <label for="">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control">
           </div>
        </section>
    </x-modalsimpan>
    
<x-modalubah judul="Edit Anggota Keluarga" link="hubungankeluarga">
    <section class="p-3">
        <div class="form-group">
            <label for="">Urutan</label>
            <input type="number" name="urutan" id="urutan" class="form-control">
       </div>
       <div class="form-group">
            <label for="">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control">
       </div>
    </section>
</x-modalubah>

<x-modalubah judul="Edit Data Keluarga" link="keluarga" id="editkeluarga">
    <section class="p-3">
        <input type="hidden" name="id" value="{{  $keluarga->id }}">
        <input type="hidden" name="orang_id" value="{{ $keluarga->orang_id }}">
        <div class="form-group">
            <label for="">Nama Keluarga</label>
            <input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control" value="{{ $keluarga->nama_keluarga }}" required>
       </div>
       <div class="form-group">
            <label for="">No KK</label>
            <input type="text" name="no_kk" id="no_kk" value="{{ $keluarga->no_kk }}" class="form-control">
       </div>
       <div class="form-group">
            <label for="">Tanggal Pernikahan</label>
            <input type="date" name="tgl_pernikahan" value="{{ $keluarga->tgl_pernikahan }}" class="form-control">
       </div>
       <div class="form-group">
            <label for="">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" value="{{ $keluarga->keterangan }}" class="form-control">
       </div>
       <div class="form-group">
            <label for="">Status Keluarga</label>
            <select name="status_keluarga" id="status_keluarga" class="form-control">
                @foreach (kingdom_statuskeluarga() as $item)
                    <option value="{{ $item}}" @if ($item == $keluarga->status_keluarga)
                        selected
                    @endif>{{ $item}}</option>
                @endforeach
            </select>
       </div>
    </section>
</x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var urutan = button.data('urutan')
                var keterangan = button.data('keterangan')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #urutan').val(urutan);
                modal.find('.modal-body #keterangan').val(keterangan);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-singel-layout>
