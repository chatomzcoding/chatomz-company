<x-mazer-layout title="CHATOMZ - Daftar Barang" alert="TRUE">
    <x-slot name="content">
      <div class="page-heading">
        <x-header head="Data Barang" active="Detail Barang"></x-header>
        <div class="section">
          <div class="row">
            <div class="col">
            
                <div class="card">
                    <div class="card-body p-2">
                        <x-sistem.kembali url="barang"></x-sistem.kembali>
                        <x-sistem.edit url="barang/{{ $barang->id }}/edit"></x-sistem.edit>
                        <x-sistem.hapus url="barang" :id="$barang->id"></x-sistem.hapus>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                 <div class="col-lg-4">
                   <div class="card">
                     <div class="card-body p-0">
                       <img src="{{ asset('img/chatomz/barang/'.$barang->photo_barang) }}" alt="" class="card-img-top img-fluid">
                       <p class="text-center">{{ $barang->keterangan }}</p>
                     </div>
                   </div>
                 </div>
                <div class="col-lg-8">
                  <div class="card">
                      <div class="card-header">
                        <strong class="text-capitalize">{{ $barang->nama_barang }}</strong>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-borderless">
                                <tr>
                                  <th>Kondisi</th>
                                  <td>{{ $barang->kondisi }}</td>
                                </tr>
                                <tr>
                                  <th>Merk</th>
                                  <td>{{ $barang->merk }}</td>
                                </tr>
                                <tr>
                                  <th>Harga Beli</th>
                                  <td>{{ rupiah($barang->harga_beli) }}</td>
                                </tr>
                                <tr>
                                  <th>Harga Juat saat ini</th>
                                  <td>{{ rupiah($barang->harga_jual) }}</td>
                                </tr>
                                <tr>
                                  <th>Sumber</th>
                                  <td>{{ $barang->sumber }}</td>
                                </tr>
                                <tr>
                                  <th>Tgl Kepemilikan</th>
                                  <td>{{ date_indo($barang->tgl_kepemilikan) }}</td>
                                </tr>
                                <tr>
                                  <th>Status Barang</th>
                                  <td>{{ $barang->status_barang }}</td>
                                </tr>
                            </table>
                          <div>
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
    </x-slot>
</x-mazer-layout>
