@section('title')
    Market - Data Pemesanan
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Pemesanan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Pemesanan</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <a href="{{ url('/produk/create')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Tambah Produk Baru </a> --}}
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Pemesanan</th>
                                <th>Alamat Pemesanan</th>
                                <th>No Telp</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($pemesanan as $item)
                            <tr>
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td>{{ $item->created_at}}</td>
                                    <td>{{ $item->nama_produk}}</td>
                                    <td class="text-center">{{ $item->jumlah}}</td>
                                    <td>{{ $item->nama_pemesan}}</td>
                                    <td>{{ $item->alamat_pengiriman}}</td>
                                    <td>{{ $item->telp}}</td>
                                    <td>{{ $item->catatan}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="8">tidak ada data</td>
                                </tr>
                            @endforelse
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    @section('script')
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            });
        </script>
    @endsection
</x-app-layout>
