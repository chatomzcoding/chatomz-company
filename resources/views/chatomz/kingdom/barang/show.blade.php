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
                        <a href="{{ url('barang/'.$barang->id.'?s=detail') }}" class="btn btn-outline-info btn-sm"><i class="bi bi-file-bar-graph"></i></a>
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
              {{-- data informasi --}}
              @if (!is_null($barang->detail))
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Informasi Detail</h4>
                      </div>
                      <div class="card-body">
                          <div class="row">
                              <div class="col-3">
                                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                      aria-orientation="vertical">
                                      
                                      @foreach (json_decode($barang->detail) as $detail => $item)
                                        <a class="nav-link @if ($loop->iteration == 1)
                                        active
                                        @endif" id="v-pills-{{ $loop->iteration }}-tab" data-bs-toggle="pill"
                                            href="#v-pills-{{ $loop->iteration }}" role="tab" aria-controls="v-pills-{{ $loop->iteration }}"
                                            aria-selected="true">{{ ucwords($detail) }}</a>
                                      @endforeach
                                  </div>
                              </div>
                              <div class="col-9">
                                  <div class="tab-content" id="v-pills-tabContent">
                                    @foreach (json_decode($barang->detail) as $detail => $item)
                                          <div class="tab-pane fade show @if ($loop->iteration == 1)
                                            active
                                            @endif" id="v-pills-{{ $loop->iteration }}" role="tabpanel"
                                              aria-labelledby="v-pills-{{ $loop->iteration }}-tab">
                                            <section class="p-2">
                                                @if (count((array) $item->format) > 0)
                                                  <div class="table-responsive">
                                                      <table class="table table-borderless">
                                                          <thead>
                                                              <tr>
                                                                <th>No</th>
                                                                  @foreach ($item->format as $i)
                                                                      <th>{{ $i->field }}</th>
                                                                  @endforeach
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                            @forelse ($item->data as $id => $i)
                                                              <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                @foreach ($item->format as $j)
                                                                    @php
                                                                        $field = $j->field
                                                                    @endphp
                                                                    <td>
                                                                        @isset($i->$field)
                                                                          {{ getdataitem($i->$field,$j->fungsi) }}
                                                                        @endisset
                                                                    </td>
                                                                @endforeach
                                                              </tr>
                                                            @empty
                                                            @php
                                                                $colspan = 1 + count((array)$item->format) 
                                                            @endphp
                                                            <tr class="text-center">
                                                              <td colspan="{{ $colspan }}">belum ada data</td>
                                                            </tr>
                                                            @endforelse
                                                          </tbody>
                                                      </table>                                      
                                                  </div>
                                                @endif
                                            </section>
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </x-slot>
</x-mazer-layout>
