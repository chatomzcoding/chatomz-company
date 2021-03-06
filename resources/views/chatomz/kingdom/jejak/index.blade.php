<x-mazer-layout title="CHATOMZ - Daftar Jejak" datatables="TRUE" select="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Jejak Kehidupan" active="Daftar Jejak">
            </x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi-plus"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="10%">Aksi</th>
                                            <th>Tanggal</th>
                                            <th>Nama Jejak</th>
                                            <th>Lokasi/Tempat</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        @forelse ($jejak as $item)
                                        <tr>
                                                <td class="text-center">{{ $loop->iteration}}</td>
                                                <td class="text-center">
                                                    <x-aksi :id="$item->id" link="jejak">
                                                        <a href="{{ url('jejak/'.Crypt::encryptString($item->id)) }}"  class="dropdown-item text-primary"><i class="fas fa-file"></i> LIHAT</a>
                                                        <button type="button" data-bs-toggle="modal"  data-nama_jejak="{{ $item->nama_jejak }}"  data-tanggal="{{ $item->tanggal }}"  data-nilai_lat="{{ $item->nilai_lat }}" data-nilai_long="{{ $item->nilai_long }}" data-keterangan_jejak="{{ $item->keterangan_jejak }}" data-kategori="{{ $item->kategori }}" data-lokasi="{{ $item->lokasi }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" data-original-title="Edit Task" class="dropdown-item text-success">
                                                            <i class="fa fa-edit"></i> EDIT
                                                        </button>
                                                    </x-aksi>
                                                </td>
                                                <td>{{ date_indo($item->tanggal,'-')}}</td>
                                                <td>{{ $item->nama_jejak}}</td>
                                                <td>
                                                    @isset($item->tempat)
                                                        {{ $item->tempat->nama}}
                                                    @endisset
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="5">tidak ada data</td>
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
        <x-modalsimpan judul="Tambah Jejak" link="jejak">
            <section class="p-3">
                <div class="form-group">
                     <label for="">Nama Jejak</label>
                     <input type="text" name="nama_jejak" id="nama_jejak" class="form-control" value="{{ old('nama_jejak') }}" required>
                </div>
                <div class="form-group">
                     <label for="">Tanggal Jejak</label>
                     <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}">
                </div>
                <div class="form-group">
                 <label for="">Tempat</label>
                 <select name="tempat_id" id="tempat_id" class="form-control select2bs4" required>
                    @foreach ($tempat as $item)
                        <option value="{{ $item->id}}">{{ strtoupper($item->nama)}}</option>
                    @endforeach
                </select>
                 </div>
                <div class="form-group">
                     <label for="">Lokasi</label>
                     <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi') }}" required>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <textarea name="keterangan_jejak" id="keterangan_jejak" cols="30" rows="4" class="form-control" required>{{ old('keterangan_jejak') }}</textarea>
                 </div>
                 <div class="form-group">
                      <label for="">Gambar</label>
                      <input type="file" name="gambar_jejak" id="nilai_long" class="form-control">
                 </div>
             </section>
        </x-modalsimpan>

        <x-modalubah judul="Edit Jejak" link="jejak">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Jejak</label>
                    <input type="text" name="nama_jejak" id="nama_jejak" class="form-control" required>
               </div>
               <div class="form-group">
                    <label for="">Tanggal Jejak</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
               </div>
               <div class="form-group">
                <label for="">Tempat</label>
                <select name="tempat_id" id="tempat_id" class="form-control" required>
                    @foreach ($tempat as $item)
                        <option value="{{ $item->id}}">{{ strtoupper($item->nama)}}</option>
                    @endforeach
                </select>
                </div>
               <div class="form-group">
                    <label for="">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" required>
               </div>
               <div class="form-group">
                   <label for="">Keterangan</label>
                   <textarea name="keterangan_jejak" id="keterangan_jejak" cols="30" rows="4" class="form-control" required></textarea>
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
                var nama_jejak = button.data('nama_jejak')
                var nilai_lat = button.data('nilai_lat')
                var nilai_long = button.data('nilai_long')
                var keterangan_jejak = button.data('keterangan_jejak')
                var kategori = button.data('kategori')
                var lokasi = button.data('lokasi')
                var tanggal = button.data('tanggal')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_jejak').val(nama_jejak);
                modal.find('.modal-body #nilai_lat').val(nilai_lat);
                modal.find('.modal-body #nilai_long').val(nilai_long);
                modal.find('.modal-body #keterangan_jejak').val(keterangan_jejak);
                modal.find('.modal-body #kategori').val(kategori);
                modal.find('.modal-body #tanggal').val(tanggal);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>