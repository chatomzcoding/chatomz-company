<x-mazer-layout title="Company - Wadec">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Produk Wadec" p="daftar produk wall decoration chatomz" active="Daftar Produk">
            </x-header>
            <section class="section">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Produk</a>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                            <table id="example1" class="table">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Aksi</th>
                                        <th>Photo</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    @forelse ($produk as $item)
                                    <tr>
                                            <td class="text-center">{{ $loop->iteration}}</td>
                                            <td class="text-center">
                                                <form id="data-{{ $item->id }}" action="{{url('/produk',$item->id)}}" method="post">
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
                                                            <button type="button" data-bs-toggle="modal"  data-nama_produk="{{ $item->nama_produk }}" data-harga="{{ $item->harga }}" data-stok="{{ $item->stok }}" data-kategori_id="{{ $item->kategori_id }}" data-deskripsi="{{ $item->deskripsi }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item" data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i> EDIT
                                                            </button>
                                                    <div class="dropdown-divider"></div>
                                                    <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item text-danger"><i class="fas fa-trash-alt w20p"></i> HAPUS</button>
                                                        </div>
                                                    </div>
                                            </td>
                                            <td><img src="{{ asset('img/company/bisnis/'.$item->poto_produk) }}" alt="" width="150px"></td>
                                            <td>{{ $item->nama_produk}}</td>
                                            <td>{{ rupiah($item->harga)}}</td>
                                            <td>{{ $item->nama_kategori}}</td>
                                            <td>{{ $item->deskripsi}}</td>
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
            </section>
        </div>
        <x-modalsimpan judul="Tambah Produk Baru" link="produk">
            <section>
                <input type="hidden" name="aplikasi" value="wadec">
                <label>Nama Produk : </label>
                <div class="form-group">
                    <input type="text" name="nama_produk" placeholder="Masukkan nama produk" class="form-control" value="{{ old('nama_produk') }}" required>
                </div>
                <label>Harga Produk : </label>
                <div class="form-group">
                    <input type="text" name="harga" id="rupiah" placeholder="Masukkan harga produk" class="form-control" value="{{ old('harga') }}" required>
                </div>
                <label>Stok Produk : </label>
                <div class="form-group">
                    <input type="number" min="1" name="stok" id="stok" class="form-control" value="{{ old('stok') }}" required>
                </div>
                <label>Kategori : </label>
                <div class="form-group">
                    <select name="kategori_id" id="" class="form-control" required>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <label>Keterangan : </label>
                <div class="form-group">
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control" required></textarea>
                </div>
                <label>Poto Produk : </label>
                <div class="form-group">
                    <input type="file" name="poto_produk" class="form-control" required>
                </div>
            </section>
        </x-modalsimpan>

        <x-modalubah judul="Ubah Data Produk" link="produk">
            <section>
                <label>Nama Produk : </label>
                <div class="form-group">
                    <input type="text" name="nama_produk" id="nama_produk" placeholder="Masukkan nama produk" class="form-control" value="{{ old('nama_produk') }}" required>
                </div>
                <label>Harga Produk : </label>
                <div class="form-group">
                    <input type="text" name="harga" id="rupiah1" placeholder="Masukkan harga produk" class="form-control" value="{{ old('harga') }}" required>
                </div>
                <label>Stok Produk : </label>
                <div class="form-group">
                    <input type="number" min="1" name="stok" id="stok" class="form-control" value="{{ old('stok') }}" required>
                </div>
                <label>Kategori : </label>
                <div class="form-group">
                    <select name="kategori_id" id="" class="form-control" required>
                        @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <label>Keterangan : </label>
                <div class="form-group">
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control" required></textarea>
                </div>
                <label>Poto Produk : </label>
                <div class="form-group">
                    <input type="file" name="poto_produk" class="form-control">
                </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script src="{{ asset('template/mazer/vendors/simple-datatables/simple-datatables.js')}}"></script>

        <script>
           // Simple Datatable
           let table1 = document.querySelector('#example1');
           let dataTable = new simpleDatatables.DataTable(table1);
       </script>
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama_produk = button.data('nama_produk')
                var harga = button.data('harga')
                var stok = button.data('stok')
                var kategori_id = button.data('kategori_id')
                var deskripsi = button.data('deskripsi')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama_produk').val(nama_produk);
                modal.find('.modal-body #rupiah1').val(harga);
                modal.find('.modal-body #stok').val(stok);
                modal.find('.modal-body #kategori_id').val(kategori_id);
                modal.find('.modal-body #deskripsi').val(deskripsi);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
