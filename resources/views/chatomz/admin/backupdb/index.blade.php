<x-mazer-layout title="Company - Usaha" alert="TRUE" select="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Backup" p="backup aplikasi" active="Daftar Backup">
            </x-header>
            <section class="section">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      {{-- <div class="card-header">
                        <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Mitra Usaha</a>
                      </div> --}}
                      <div class="card-body">
                         <table class="table table-striped">
                             <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>Aksi</th>
                                     <th>Tanggal Backup</th>
                                     <th>Aplikasi</th>
                                     <th>Nama Backup</th>
                                     <th>Data</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($backupdb as $item)
                                     <tr>
                                         <td>{{ $loop->iteration }}</td>
                                         <td>
                                             <x-aksi link="backupdb" id="{{ $item->id }}"></x-aksi>
                                         </td>
                                         <td>{{ date_indo($item->tgl) }}</td>
                                         <td>{{ $item->aplikasi }}</td>
                                         <td>{{ $item->nama }}</td>
                                         <td><a href="{{ url('backupdb/'.$item->id) }}">LIHAT DATA</a></td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
        </div>
    </x-slot>
</x-mazer-layout>
