<x-mazer-layout title="CHATOMZ - Daftar Orang" datatables="TRUE" select="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Orang</h3>
                        <p class="text-subtitle text-muted">daftar list orang - orang</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar Orang</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <a href="{{ url('/orang/create')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Tambah Orang Baru </a>
                        <a href="{{ url('/lihat/orangpoto')}}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-sync"></i> View Photo</a>
                        <a href="{{ url('/statistik/orang')}}" class="btn btn-outline-info btn-flat btn-sm"><i class="fas fa-chart"></i> Statistik</a>
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
                                                <form id="data-{{ $item->id }}" action="{{url('/orang',$item->id)}}" method="post">
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
                                                            <a href="{{ url('/orang/'.Crypt::encryptString($item->id).'/edit')}}" class="dropdown-item text-success"><i class="fas fa-pen" style="width: 20px;"></i> EDIT</a>
                                                    <div class="dropdown-divider"></div>
                                                    <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item text-danger"><i class="fas fa-trash-alt w20p"></i> HAPUS</button>
                                                        </div>
                                                    </div>
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
