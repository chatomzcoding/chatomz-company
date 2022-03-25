<x-mazer-layout title="COMPANY - Detail usaha" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Mitra Usaha" active="Detail">
                <li class="breadcrumb-item"><a href="{{ url('usaha')}}">Daftar Usaha</a></li>
            </x-header>
            <section class="section">
                <div class="row">
                    <div class="col-4">
                        <div class="card border">
                            <div class="card-content">
                                @if (is_null($usaha->gambar_lokasi))
                                    <img src="{{ asset('img/usaha.png')}}" class="card-img-top img-fluid" alt="gambar">
                                    @else
                                    <img src="{{ asset('img/company/bisnis/usaha/'.$usaha->gambar_lokasi)}}" class="card-img-top img-fluid" alt="gambar">
                                @endif
                                <div class="card-body py-2">
                                    <i class="bi-person"></i> <span>Owner <a href="{{ url('orang/'.Crypt::encryptString($usaha->orang->id)) }}">{{ fullname($usaha->orang)}}</a></span>
                                    <p class="card-text fst-italic">
                                    </p>
                                    <form id="data-{{ $usaha->id }}" action="{{url('/usaha/'.$usaha->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <hr>
                                    <div class="d-flex justify-content-center">
                                        <section class="p-1">
                                            <button onclick="deleteRow( {{ $usaha->id }} )" class="btn btn-icon btn-round btn-outline-danger pop-info" title="hapus orang"><i class="bi-trash"></i></button>
                                        </section>
                                        <section class="p-1">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#ubahusaha" class="btn btn-icon btn-round btn-outline-success pop-info" title="Edit Orang"  data-id="{{ $usaha->id }}" data-nama_usaha="{{ $usaha->nama_usaha }}" data-lokasi="{{ $usaha->lokasi }}" data-bidang="{{ $usaha->bidang }}" data-orang_id="{{ $usaha->orang_id }}" data-status="{{ $usaha->status }}"><i class="bi-pencil"></i></a>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{ $usaha->nama_usaha }}</h5>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Tentang</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="produk-tab" data-bs-toggle="tab" href="#produk"
                                            role="tab" aria-controls="produk" aria-selected="false">Produk <span class="badge bg-primary">{{ count($usaha->produk) }}</span></a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact"
                                            role="tab" aria-controls="contact" aria-selected="false">Statistik</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="p-3">
                                            <strong><i class="bi-map"></i> Alamat</strong>
                                            <div class="py-0 px-3">
                                                <p class="text-muted">
                                                  {{ $usaha->lokasi }}
                                                </p>
                                            </div>
                                            <hr>
                                            <strong><i class="bi-file mr-1"></i> Bidang</strong>
                                            <div class="py-0 px-3">
                                                  <p class="text-muted">{{ $usaha->bidang}}</p>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="produk" role="tabpanel"
                                        aria-labelledby="produk-tab">
                                        <main class="p-2 mt-2">
                                            <section>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-outline-primary btn-sm"><i class="bi-plus"></i> Tambah Produk</a>
                                            </section>
                                            <section>
                                                <div class="">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Aksi</th>
                                                                <th>Logo Usaha</th>
                                                                <th>Nama Produk</th>
                                                                <th>Harga Produk</th>
                                                                <th>Stok Produk</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($usaha->produk as $item)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        <x-aksi :id="$item->id" link="produk">
                                                                            <button type="button" data-bs-toggle="modal"  data-nama_produk="{{ $item->nama_produk }}" data-harga="{{ $item->harga }}" data-stok="{{ $item->stok }}" data-kategori_id="{{ $item->kategori_id }}" data-deskripsi="{{ $item->deskripsi }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                                                <i class="bi-pencil"></i> EDIT
                                                                            </button>
                                                                        </x-aksi>
                                                                    </td>
                                                                    <td><img src="{{ asset('img/company/bisnis/'.$item->poto_produk) }}" alt="produk" width="100px" class="rounded"></td>
                                                                    <td>{{ $item->nama_produk }}</td>
                                                                    <td>{{ norupiah($item->harga) }}</td>
                                                                    <td class="text-center">{{ $item->stok }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr class="text-center">
                                                                    <td colspan="6">belum ada produk</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </section>
                                        </main>
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel"
                                        aria-labelledby="contact-tab">
                                        -
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <x-modalsimpan judul="Tambah Produk Baru" link="produk">
                <section>
                    <input type="hidden" name="aplikasi" value="marketplace">
                    <input type="hidden" name="usaha_id" value="{{ $usaha->id }}">
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
                    <label>Logo Usaha : </label>
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
                    <label>Logo Usaha : </label>
                    <div class="form-group">
                        <input type="file" name="poto_produk" class="form-control">
                    </div>
                </section>
            </x-modalubah>
            <x-modalubah judul="Ubah Data Usaha" link="usaha" id="ubahusaha">
                <section>
                    <input type="hidden" id="id" name="id">
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
                    <label>Logo Usaha : </label>
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
         <script>
            $('#ubahusaha').on('show.bs.modal', function (event) {
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
