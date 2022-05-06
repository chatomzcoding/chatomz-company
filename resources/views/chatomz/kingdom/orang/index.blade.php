<x-mazer-layout title="CHATOMZ - Daftar Orang" datatables="TRUE" select="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Orang" p="Daftar list orang - orang" active="Daftar Orang"></x-header>
            <section class="section">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <a href="{{ url('/orang/create')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="bi-plus-circle-fill"></i></a>
                        <a href="{{ url('/lihat/orangpoto')}}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-card-image"></i></a>
                        <a href="{{ url('/statistik/orang')}}" class="btn btn-outline-info btn-flat btn-sm"><i class="bi-bar-chart"></i></a>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Aksi</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    @forelse ($orang as $item)
                                    <tr>
                                            <td class="text-center">{{ $loop->iteration}}</td>
                                            <td class="text-center">
                                                <x-aksi :id="$item->id" link="orang">
                                                    <a href="{{ url('/orang/'.Crypt::encryptString($item->id).'/edit')}}" class="dropdown-item text-success"><i class="fas fa-pen" style="width: 20px;"></i> EDIT</a>
                                                </x-aksi>
                                            </td>
                                            <td><a href="{{ url('/orang/'.Crypt::encryptString($item->id))}}">{{ $item->first_name.' '.$item->last_name}}</a></td>
                                            <td class="text-center">{{ $item->gender}}</td>
                                            <td>{{ $item->home_address}}</td>
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
    </x-slot>

</x-mazer-layout>
