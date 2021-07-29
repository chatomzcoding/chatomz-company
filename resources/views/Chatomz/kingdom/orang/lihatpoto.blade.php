@section('title')
    CHATOMZ - Daftar Orang
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Orang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar Orang</li>
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
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                {{-- <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Klasifikasi Baru </a> --}}
                <a href="{{ url('/orang')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Kembali ke daftar orang</a>
                <span class="float-right">{{  count($orang) }} Orang</span>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="row">
                      <div class="col-md-12">
                        <form action="{{  url('/proses/lihat/orangpoto') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="small">Jenis Kelamin</label>
                                        <select name="kelamin" id="" class="form-control" onchange="this.form.submit()">
                                            <option value="semua" @if ($sesi['kelamin'] == 'semua')
                                                selected
                                            @endif>Semua</option>
                                            <option value="laki-laki"  @if ($sesi['kelamin'] == 'laki-laki')
                                            selected
                                            @endif>Laki - laki</option>
                                                <option value="perempuan"  @if ($sesi['kelamin'] == 'perempuan')
                                                selected
                                            @endif>Perempuan</option>
                                                <option value="lainnya"  @if ($sesi['kelamin'] == 'lainnya')
                                                selected
                                            @endif>Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="small">Status Perkawinan</label>
                                        <select name="perkawinan" id="" class="form-control" onchange="this.form.submit()">
                                            <option value="semua" @if ($sesi['perkawinan'] == 'semua')
                                                selected
                                            @endif >Semua</option>
                                            <option value="belum" @if ($sesi['perkawinan'] == 'belum')
                                                selected
                                            @endif >Belum Kawin</option>
                                            <option value="sudah" @if ($sesi['perkawinan'] == 'sudah')
                                                selected
                                            @endif>Sudah Kawin</option>
                                            <option value="pernah" @if ($sesi['perkawinan'] == 'pernah')
                                                selected
                                            @endif>Pernah Kawin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="small">Usia Awal</label>
                                        <select name="usia1" id="" class="form-control" onchange="this.form.submit()">
                                          @for ($i = 0; $i < 100; $i++)
                                              <option value="{{ $i }}"  @if ($sesi['usia1'] == $i)
                                              selected
                                          @endif>{{ $i }} Tahun</option>
                                          @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="small">Usia Akhir</label>
                                        <select name="usia2" id="" class="form-control" onchange="this.form.submit()">
                                          @for ($i = 0; $i <= 100; $i++)
                                              <option value="{{ $i }}"  @if ($sesi['usia2'] == $i)
                                              selected
                                          @endif>{{ $i }} Tahun</option>
                                          @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                      </div>
                        @forelse ($orang as $item)
                            <div class="col-md-2">
                                <div class="card w-100">
                                    <a href="{{ url('/orang/'.Crypt::encryptString($item->id))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img-top" alt="..."></a>
                                    <div class="card-body p-1 text-center">
                                    <small class="text-capitalize">{{ $item->first_name.' '.$item->last_name}}</small>
                                    {{-- <p class="card-text">{{ $item->home_address}}</p> --}}
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="col-md-12">
                            <div class="alert alert-warning text-center">
                                tidak ada data
                            </div>
                        </div>
                        @endforelse
                  </div> 
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
                "buttons": ["pdf"]
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
