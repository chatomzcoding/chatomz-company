<x-mazer-layout title="CHATOMZ - Detail Jejak" select="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Jejak" active="Detail">
                <li class="breadcrumb-item"><a href="{{ url('jejak')}}">Daftar Jejak</a></li>
            </x-header>
            <div class="section">
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <x-sistem.kembali url="jejak"></x-sistem.kembali>
                        <x-sistem.tambah id="tambahpoto"></x-sistem.tambah>
                        <a href="#" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#ubahdata"><i class="bi-pencil"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <section class="p-2 text-center">
                                    <img src="{{ asset('img/chatomz/jejak/'.$jejak->gambar_jejak) }}" class="d-block w-100" alt="poto utama">
                                    <small class="text-capitalize">{{ $jejak->lokasi }}</small>
                                </section>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-capitalize">{{ $jejak->nama_jejak }}</h4><hr>
                                <div class="text-right">
                                    <span>{{ date_indo($jejak->tanggal,'-') }}</span>
                                </div>
                                <p class="font-italic">"{{ $jejak->keterangan_jejak }}"</p>
                                @isset($jejak->tempat)
                                    Lokasi : {{ $jejak->tempat->nama }}
                                @endisset
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="card">
                                    <div class="card-header">
                                        <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Orang yang terlibat</a>
                                        <span class="btn btn-success btn-sm float-end">Total Orang {{ count($jejakorang) }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @forelse ($jejakorang as $item)
                                            <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                                                <div class="card mb-3 w-100">
                                                    <div class="row no-gutters">
                                                        <form id="data-{{ $item->id }}" action="{{url('/jejakorang',$item->id)}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        <div class="col-md-4">
                                                            <a id="dropdownMenuButton" data-bs-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" class="w-100">
                                                                <img src="{{ asset('/img/chatomz/orang/'.$item->photo)}}" class="card-img" alt="...">
                                                            </a>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="{{ url('/orang/'.Crypt::encryptString($item->orang_id))}}"><i class="fa fa-user text-primary" style="width: 25px"></i> DETAIL</a>
                                                                    <button type="button" data-bs-toggle="modal" data-ket_orang="{{ $item->ket_orang }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item" data-original-title="Edit Task">
                                                                        <i class="fa fa-edit text-success" style="width: 25px"></i> EDIT</i>
                                                                    </button>
                                                                    <a onclick="deleteRow( {{ $item->id }} )" type="button" class="dropdown-item"><i class="fa fa-trash-alt text-danger" style="width: 25px"></i> HAPUS</a>
                                                                </div>
                                                        </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body p-2">
                                                        <h6 class="card-title">
                                                            {{ fullname($item)}} 
                                                            @if ($item->gender == 'laki-laki')
                                                                    <sup><i class="fas fa-mars text-primary"></i></sup>  
                                                                @else
                                                                    <sup><i class="fas fa-venus text-danger"></i></sup>  
                                                                @endif
                                                        </h6>
                                                        <small>{{ $item->ket_orang }}</small>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                @empty
                                                    <div class="col text-center">
                                                        belum ada data orang yang terlibat
                                                    </div>
                                                @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <x-modalsimpan judul="Tambah Orang Dalam Poto" link="jejakorang">
            <input type="hidden" name="jejak_id" value="{{ $jejak->id }}">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama </label>
                    <select class="select2bs4" data-height="100%" data-width="100%" name="orang_id" required>
                        @foreach ($orang as $item)
                            <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Catatan (opsional)</label>
                    <input type="text" name="ket_orang" id="ket_orang" class="form-control">
                </div>
            </section>
        </x-modalsimpan>
        <x-modalubah judul="Edit Orang yang terlibat" link="jejakorang">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Catatan (opsional)</label>
                    <input type="text" name="ket_orang" id="ket_orang" class="form-control">
                </div>
            </section>
        </x-modalubah>

        <x-modalsimpan judul="Tambah Poto" link="jejakpoto" id="tambahpoto">
            <input type="hidden" name="jejak_id" value="{{ $jejak->id }}">
            <section class="p-3">
                <div class="form-group">
                     <label for="">Upload Poto</label>
                     <input type="file" name="poto" id="poto" class="form-control">
                </div>
                <div class="form-group">
                     <label for="">Keterangan Photo (opsional)</label>
                     <input type="text" name="ket_poto" id="ket_poto" class="form-control">
                </div>
             </section>
        </x-modalsimpan>

        <x-modalubah judul="edit jejak" link="jejak" id="ubahdata">
            <input type="hidden" name="id" value="{{ $jejak->id }}">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Jejak</label>
                    <input type="text" name="nama_jejak" id="nama_jejak" class="form-control"  value="{{ $jejak->nama_jejak }}" required>
               </div>
               <div class="form-group">
                    <label for="">Tanggal Jejak</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control"  value="{{ $jejak->tanggal }}">
               </div>
               <div class="form-group">
                <label for="">Tempat/Lokasi</label>
                <select name="tempat_id" class="form-control select2bs4" required>
                    @foreach ($tempat as $item)
                        <option value="{{ $item->id}}" @if ($item->id == $jejak->tempat_id)
                            selected
                        @endif>{{ strtoupper($item->nama)}}</option>
                    @endforeach
                </select>
                </div>
               <div class="form-group">
                    <label for="">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control"  value="{{ $jejak->lokasi }}" required>
               </div>
               <div class="form-group">
                   <label for="">Keterangan</label>
                   <textarea name="keterangan_jejak" id="keterangan_jejak" cols="30" rows="4" class="form-control" required>{{ $jejak->keterangan_jejak }}</textarea>
                </div>
                <div class="form-group">
                     <label for="">Gambar</label>
                     <input type="file" name="gambar_jejak" class="form-control">
                </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var ket_orang = button.data('ket_orang')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #ket_orang').val(ket_orang);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
