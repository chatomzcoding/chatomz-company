<x-mazer-layout>
    <x-slot name="title">
        CHATOMZ - Daftar Orang
    </x-slot>
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
                        <a href="{{ url('/lihat/orangpoto/semua')}}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-sync"></i> View Photo</a>
                      </div>
                      <div class="card-body">
                          @include('sistem.notifikasi')
                          {{-- <section class="text-right my-2">
                              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Data</button>
                          </section> --}}
                          {{-- <section class="mb-3">
                              <form action="" method="post">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <select name="" id="" class="form-control form-control-sm">
                                            <option value="">-- Semua --</option>
                                            @foreach (list_status() as $item)
                                                <option value="{{ $item}}">{{ $item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                          </section> --}}
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
                                                        <button class="btn btn-info dropdown-toggle me-1" type="button"
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
