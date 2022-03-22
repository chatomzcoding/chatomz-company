<x-mazer-layout title="CHATOMZ - Daftar Keluarga" datatables="TRUE" select="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Keluarga" active="Daftar Keluarga">
            </x-header>
            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Keluarga </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="10%">Aksi</th>
                                            <th>Nama Keluarga</th>
                                            <th>Tgl Pernikahan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        @forelse ($keluarga as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration}}</td>
                                            <td class="text-center">
                                                <x-aksi :id="$item->id" link="keluarga">
                                                    <button type="button" data-bs-toggle="modal"  data-nama_keluarga="{{ $item->nama_keluarga }}"  data-no_kk="{{ $item->no_kk }}"  data-orang_id="{{ $item->orang_id }}" data-tgl_pernikahan="{{ $item->tgl_pernikahan }}" data-keterangan="{{ $item->keterangan }}" data-status_keluarga="{{ $item->status_keluarga }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                        <i class="fa fa-edit" style="width: 20px;"></i> EDIT
                                                    </button>
                                                </x-aksi>
                                            </td>
                                                <td><a href="{{ url('/keluarga/'.Crypt::encryptString($item->id))}}">{{ $item->nama_keluarga}}</a></td>
                                                <td>{{ date_indo($item->tgl_pernikahan,'-')}}</td>
                                                <td class="text-center">{{ $item->status_keluarga}}</td>
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
            </section>
        </div>
        <x-modalsimpan judul="Tambah Keluarga" link="keluarga">
            <section class="p-3">
                <div class="form-group">
                     <label for="">Nama Keluarga {!! ireq() !!}</label>
                     <input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Kepala Keluarga {!! ireq() !!}</label>
                    <select name="orang_id" class="select2bs4" data-width="100%" required>
                        @foreach ($kepalakeluarga as $item)
                            @if (!DbChatomz::cekstatussuami($item->id))
                                <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                            @endif
                        @endforeach
                    </select>
                 </div>
                <div class="form-group">
                     <label for="">No KK</label>
                     <input type="text" name="no_kk" id="no_kk" class="form-control">
                </div>
                <div class="form-group">
                     <label for="">Tanggal Pernikahan</label>
                     <input type="date" name="tgl_pernikahan" id="tgl_pernikahan" class="form-control">
                </div>
                <div class="form-group">
                     <label for="">Keterangan</label>
                     <input type="text" name="keterangan" id="keterangan" class="form-control">
                </div>
                <div class="form-group">
                     <label for="">Status Keluarga {!! ireq() !!}</label>
                     <select name="status_keluarga" id="status_keluarga" class="form-control" required>
                         @foreach (kingdom_statuskeluarga() as $item)
                             <option value="{{ $item}}">{{ $item}}</option>
                         @endforeach
                     </select>
                </div>
             </section>
        </x-modalsimpan>
        
        <x-modalubah judul="Edit Keluarga" link="keluarga">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Keluarga {!! ireq() !!}</label>
                    <input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control" required>
               </div>
               <div class="form-group">
                    <label for="">Kepala Keluarga {!! ireq() !!}</label>
                    <select name="orang_id" id="orang_id" class="select2bs4" data-width="100%" required>
                            <option value="">-- kepala keluarga --</option>
                        @foreach ($kepalakeluarga as $item)
                            <option value="{{ $item->id}}">{{ ucwords($item->first_name.' '.$item->last_name)}}</option>
                        @endforeach
                    </select>
                </div>
               <div class="form-group">
                    <label for="">No KK</label>
                    <input type="text" name="no_kk" id="no_kk" class="form-control">
               </div>
               <div class="form-group">
                    <label for="">Tanggal Pernikahan</label>
                    <input type="date" name="tgl_pernikahan" id="tgl_pernikahan" class="form-control">
               </div>
               <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control">
               </div>
               <div class="form-group">
                    <label for="">Status Keluarga {!! ireq() !!}</label>
                    <select name="status_keluarga" id="status_keluarga" class="form-control" required>
                        @foreach (kingdom_statuskeluarga() as $item)
                            <option value="{{ $item}}">{{ $item}}</option>
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
                var nama_keluarga = button.data('nama_keluarga')
                var no_kk = button.data('no_kk')
                var tgl_pernikahan = button.data('tgl_pernikahan')
                var keterangan = button.data('keterangan')
                var status_keluarga = button.data('status_keluarga')
                var orang_id = button.data('orang_id')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_keluarga').val(nama_keluarga);
                modal.find('.modal-body #no_kk').val(no_kk);
                modal.find('.modal-body #tgl_pernikahan').val(tgl_pernikahan);
                modal.find('.modal-body #keterangan').val(keterangan);
                modal.find('.modal-body #status_keluarga').val(status_keluarga);
                modal.find('.modal-body #orang_id').val(orang_id);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
