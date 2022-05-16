<x-mazer-layout title="CHATOMZ - Daftar Barang" alert="TRUE">
    <x-slot name="content">
      <div class="page-heading">
        <x-header head="Data Barang" active="Tambah Barang"></x-header>
        <div class="section">
          <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <x-sistem.kembali url="barang"></x-sistem.kembali>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('barang') }}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-3">
                                        <label for="" class="col-form-label">Nama Barang</label>
                                    </div>
                                    <div class="col-lg-9 col-9">
                                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" class="form-control" autocomplete="off" placeholder="nama barang" required>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-3">
                                        <label for="" class="col-form-label">Merk Barang</label>
                                    </div>
                                    <div class="col-lg-9 col-9">
                                        <input type="text" name="merk" value="{{ old('merk') }}" class="form-control" autocomplete="off" placeholder="merk barang">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-3">
                                        <label for="" class="col-form-label">Sumber Barang</label>
                                    </div>
                                    <div class="col-lg-9 col-9">
                                        <input type="text" name="sumber" value="{{ old('sumber') }}" class="form-control" autocomplete="off" placeholder="sumber barang">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-3">
                                        <label for="" class="col-form-label">Keterangan</label>
                                    </div>
                                    <div class="col-lg-9 col-9">
                                        <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control" autocomplete="off" placeholder="keterangan" required>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-3">
                                        <label for="" class="col-form-label">Harga Barang</label>
                                    </div>
                                    <div class="col-lg-9 col-9">
                                        <input type="text" name="harga_beli" id="rupiah" value="{{ old('harga_beli') }}" class="form-control" autocomplete="off" placeholder="harga barang">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-3">
                                        <label for="" class="col-form-label">Harga Saat ini</label>
                                    </div>
                                    <div class="col-lg-9 col-9">
                                        <input type="text" name="harga_jual" id="rupiah1" value="{{ old('harga_jual') }}" class="form-control" autocomplete="off" placeholder="harga barang">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-3">
                                        <label for="" class="col-form-label">Kondisi Barang</label>
                                    </div>
                                    <div class="col-lg-9 col-9">
                                        <select name="kondisi" id="kondisi" class="form-control">
                                            @foreach (list_kondisibarang() as $item)
                                                <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-3">
                                        <label for="" class="col-form-label">Status Barang</label>
                                    </div>
                                    <div class="col-lg-9 col-9">
                                        <select name="status_barang" id="status_barang" class="form-control">
                                            @foreach (list_statusbarang() as $item)
                                                <option value="{{ $item }}">{{ strtoupper($item) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-3">
                                        <label for="" class="col-form-label">Tanggal Kepemilikan</label>
                                    </div>
                                    <div class="col-lg-9 col-9">
                                        <input type="date" name="tgl_kepemilikan" value="{{ old('tgl_kepemilikan') }}" class="form-control">
                                    </div>
                                </div>
                              
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-3 col-3">
                                        <label for="" class="col-form-label">Gambar Barang</label>
                                    </div>
                                    <div class="col-lg-9 col-9">
                                        <input type="file" name="photo_barang" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group text-end">
                                   <button type="submit" class="btn btn-primary btn-sm"><i class="bi-save"></i> SIMPAN</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </x-slot>
</x-mazer-layout>
