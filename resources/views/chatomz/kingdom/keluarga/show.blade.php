<x-singel-layout>
    <x-slot name="title">
        CHATOMZ - Data Keluarga {{ $keluarga->nama_keluarga}}
    </x-slot>
    <x-slot name="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if (isset($pohon['istri']))
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"> Tambah Anggota Keluarga </a>
                        @endif
                        <a href="#" data-bs-toggle="modal" data-bs-target="#editkeluarga" class="btn btn-outline-success btn-flat btn-sm"> Edit Keluarga</a>
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
                                <table id="example1" class="table table-bordered">
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
                                        @forelse ($keluargahubungan as $item)
                                        <tr>
                                                <td class="text-center">{{ $loop->iteration}}</td>
                                                <td class="text-center">
                                                    <form id="data-{{ $item->id }}" action="{{url('/hubungankeluarga',$item->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        </form>
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary btn-sm dropdown-toggle me-1" type="button"
                                                                id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                Aksi
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                {{-- <a href="{{ url('/orang/'.Crypt::encryptString($item->id).'/edit')}}" class="dropdown-item text-success"><i class="fas fa-pen" style="width: 20px;"></i> EDIT</a> --}}
                                                                <button type="button" data-bs-toggle="modal"   data-urutan="{{ $item->urutan }}" data-keterangan="{{ $item->keterangan }}" data-status="{{ $item->status }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item" data-original-title="Edit Task">
                                                                    <i class="fa fa-edit"></i> EDIT
                                                                </button>
                                                        <div class="dropdown-divider"></div>
                                                        <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item text-danger"><i class="fas fa-trash-alt w20p"></i> HAPUS</button>
                                                            </div>
                                                        </div>
                                                </td>
                                                <td class="text-center text-uppercase">{{ $item->status}}</td>
                                                <td><a href="{{ url('/orang/'.Crypt::encryptString($item->orang_id))}}">{{ $item->first_name.' '.$item->last_name}}</a> </td>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                  <strong>Pohon Keluarga</strong> 
                  @if ($keluarga->status_keluarga == 'menikah')
                      <span class="badge badge-info float-end-end">Status Pernikahan {{ $keluarga->status_keluarga }}</span>
                    @else
                      <span class="badge badge-warning float-end-end">Status Pernikahan {{ $keluarga->status_keluarga }}</span>
                  @endif
              </div>
              <div class="card-body">
                  {{-- baris kepala keluarga dan istri --}}
                  <div class="row justify-content-center">
                      <div class="col-md-3 pb-0">
                          <div class="card bg-primary mb-0">
                              <div class="row no-gutters">
                                <div class="col-md-4">
                                  <a href="{{ url('/orang/'.Crypt::encryptString($pohon['suami']->id))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($pohon['suami']->photo))}}" class="card-img" alt="..."></a>
                                </div>
                                <div class="col-md-8">
                                  <div class="card-body p-2 text-white">
                                      
                                      <small class="text-capitalize">{{ fullname($pohon['suami'])}} 
                                          {{-- cek keturunan keatas --}}
                                          @if ($pohon['ortusuami'])
                                           <a href="{{ url('keluarga/'.Crypt::encryptString($pohon['ortusuami']->keluarga_id)) }}" class="badge badge-light float-end"><span><i class="bi bi-arrow-up-right"></i></span></a>
                                          @endif
                                      <br> <i>suami</i></small>
                                    </div>
                                </div>
                              </div>
                            </div>
                      </div>
                      @if ($pohon['istri'])
                        <div class="col-md-3 pb-0">
                            <div class="card bg-info mb-0">
                                <div class="row no-gutters">
                                <div class="col-md-4">
                                    <a href="{{ url('/orang/'.Crypt::encryptString($pohon['istri']->idorang))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($pohon['istri']->photo))}}" class="card-img" alt="..."></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-2 text-white">
                                    <small class="text-capitalize">{{ fullname($pohon['istri'])}}
                                        @if ($pohon['ortuistri'])
                                        <a href="{{ url('keluarga/'.Crypt::encryptString($pohon['ortuistri']->keluarga_id)) }}" class="badge badge-light float-end"><span><i class="bi bi-arrow-up-right"></i></span></a>
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
                                <div class="col-md-4">
                                    <img src="{{ asset('/img/istri.png')}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-2 text-white">
                                    <small class="text-capitalize">Belum ada Data
                                    </small><br>
                                    <a href="#" data-target="#tambahistri" data-toggle="modal" class="btn btn-outline-light btn-sm">Tambahkan Istri</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                      @endif
                </div>
                {{-- garis keturunan --}}
                <div class="row justify-content-center">
                    <div class="col-md-3 akar-utama">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-3 akar-kiri">
                    </div>
                    <div class="col-md-3 akar-kanan">
                    </div>
                </div>
                @if (count($keluargahubungan) < 2)
                    <div class="row justify-content-center">
                        <div class="col-md-3 bg-secondary text-center small text-italic">
                            belum ada data
                        </div>
                    </div>
                @endif
                <div class="row justify-content-center">
                    @if (count($keluargahubungan) > 4)
                        @for ($i = 1; $i < 4; $i++)
                            <div class="col-md-3 akar-anak">
                            </div>
                        @endfor
                    @endif
                </div>
                <div class="row justify-content-center text-white">
                    @foreach ($keluargahubungan as $item)
                        @if ($item->status <> 'istri')
                            <div class="col-md-3">
                                <div class="card bg-success mb-3">
                                    <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <a href="{{ url('/orang/'.Crypt::encryptString($item->idorang))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="..."></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body p-2">
                                        <small class="text-capitalize">{{ fullname($item)}}
                                            @php
                                                $keturunan = DbChatomz::cekketurunankeluarga($item->idorang,$item->gender);
                                            @endphp
                                            @if ($keturunan)
                                                <a href="{{ url('keluarga/'.Crypt::encryptString($keturunan)) }}" class="badge badge-light float-end"><span><i class="bi bi-arrow-down-left"></i></span></a>
                                            @endif
                                            <br>
                                        Anak {{ $item->urutan }} | <i>{{ $item->gender }}</i></small>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
    @if (isset($pohon['istri']))
        <div class="modal fade" id="tambah">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ url('/hubungankeluarga')}}" method="post">
                    @csrf
                    <input type="hidden" name="keluarga_id" value="{{ $keluarga->id }}">
                    <input type="hidden" name="status" value="anak">
                <div class="modal-header">
                <h4 class="modal-title">Tambah Anggota Keluarga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body p-3">
                    <section class="p-3">
                        <div class="form-group row">
                            <label for="" class="col-md-4">Nama Anggota Keluarga</label>
                            <div class="col-md-8 p-0">
                                <select name="orang_id" class="select2bs4" data-width="100%">
                                    @foreach ($anggotakeluarga as $item)
                                        @if ($item->id <> $pohon['suami']->id AND $item->id <> $pohon['istri']->idorang)
                                        <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    <div class="form-group row">
                            <label for="" class="col-md-4">Urutan</label>
                            <div class="col-md-8 p-0">
                                <input type="number" name="urutan" id="urutan" class="form-control">
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="" class="col-md-4">Keterangan</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="keterangan" id="keterangan" class="form-control">
                            </div>
                    </div>
                    </section>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
                </div>
            </form>
            </div>
            </div>
        </div>
    @endif
    <div class="modal fade" id="tambahistri">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/hubungankeluarga')}}" method="post">
                @csrf
                <input type="hidden" name="keluarga_id" value="{{ $keluarga->id }}">
                <input type="hidden" name="status" value="istri">
                <input type="hidden" name="urutan" value="1">
            <div class="modal-header">
            <h4 class="modal-title">Tambahkan Istri</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                         <label for="" class="col-md-4">Nama Istri</label>
                         <div class="col-md-8 p-0">
                             <select name="orang_id" class="select2bs4" data-width="100%">
                                 @foreach ($daftaristri as $item)
                                    @if (!DbChatomz::cekstatusistri($item->id))
                                        <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                                    @endif
                                 @endforeach
                             </select>
                         </div>
                    </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8">
                   </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    
<x-modalubah judul="Edit Anggota Keluarga" link="hubungankeluarga">
    <section class="p-3">
        <div class="form-group row">
            <label for="" class="col-md-4">Urutan</label>
            <input type="number" name="urutan" id="urutan" class="form-control col-md-8">
       </div>
       <div class="form-group row">
            <label for="" class="col-md-4">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8">
       </div>
    </section>
</x-modalubah>
    <div class="modal fade text-left modal-borderless" id="editkeluarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <form action="{{ route('keluarga.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Keluarga</h4>
            <button type="button" class="close rounded-pill"
                data-bs-dismiss="modal" aria-label="Close"> <i data-feather="x"></i>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <input type="hidden" name="id" value="{{  $keluarga->id }}">
                    <input type="hidden" name="orang_id" value="{{ $keluarga->orang_id }}">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Nama Keluarga</label>
                        <input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control col-md-8" value="{{ $keluarga->nama_keluarga }}" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">No KK</label>
                        <input type="text" name="no_kk" id="no_kk" value="{{ $keluarga->no_kk }}" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tanggal Pernikahan</label>
                        <input type="date" name="tgl_pernikahan" value="{{ $keluarga->tgl_pernikahan }}" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" value="{{ $keluarga->keterangan }}" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Status Keluarga</label>
                        <select name="status_keluarga" id="status_keluarga" class="form-control col-md-8">
                            @foreach (kingdom_statuskeluarga() as $item)
                                <option value="{{ $item}}" @if ($item == $keluarga->status_keluarga)
                                    selected
                                @endif>{{ $item}}</option>
                            @endforeach
                        </select>
                   </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- /.modal -->

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
