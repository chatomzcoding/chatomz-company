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
                <li class="breadcrumb-item active">Filter Grup</li>
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
                <a href="{{ url('/grup')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-angle-left"></i> Kembali ke daftar grup</a>
                @if (!is_null($data['grup']))
                    <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Anggota Grup </a>
                    <a href="{{ url('/lihat/grup/'.$data['grup']->id.'_semua_semua_0_100') }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-sync"></i> Ulangi Filter </a>
                    <span class="float-right">{{  count($data['anggota']) }} Orang</span>
                @endif

              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="row">
                      <div class="col-md-12">
                        <form action="{{  url('/proses/lihat/grup') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="small">Nama Grup</label>
                                        <select name="id" id="" class="form-control" onchange="this.form.submit()">
                                            <option value="">-- pilih grup --</option>
                                            @foreach ($listgrup as $item)
                                                <option value="{{ $item->id }}"  @if ($data['id'] == $item->id)
                                                selected
                                            @endif>{{ strtoupper($item->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($data['id'] == 'pilih')
                                    <input type="hidden" name="kelamin" value="semua">
                                    <input type="hidden" name="perkawinan" value="semua">
                                    <input type="hidden" name="usia1" value="0">
                                    <input type="hidden" name="usia2" value="100">
                                @else
                                <div class="col-md-2">
                                    <div class="form-group">
                                            <label for="" class="small">Jenis Kelamin</label>
                                            <select name="kelamin" id="" class="form-control" onchange="this.form.submit()">
                                                <option value="semua" @if ($data['kelamin'] == 'semua')
                                                    selected
                                                @endif>Semua</option>
                                                <option value="laki-laki"  @if ($data['kelamin'] == 'laki-laki')
                                                selected
                                                @endif>Laki - laki</option>
                                                <option value="perempuan"  @if ($data['kelamin'] == 'perempuan')
                                                selected
                                                @endif>Perempuan</option>
                                                <option value="lainnya"  @if ($data['kelamin'] == 'lainnya')
                                                selected
                                                @endif>Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="small">Status Perkawinan</label>
                                            <select name="perkawinan" id="" class="form-control" onchange="this.form.submit()">
                                                <option value="semua" @if ($data['perkawinan'] == 'semua')
                                                    selected
                                                @endif >Semua</option>
                                                <option value="belum" @if ($data['perkawinan'] == 'belum')
                                                    selected
                                                @endif >Belum Kawin</option>
                                                <option value="sudah" @if ($data['perkawinan'] == 'sudah')
                                                    selected
                                                @endif>Sudah Kawin</option>
                                                <option value="pernah" @if ($data['perkawinan'] == 'pernah')
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
                                                <option value="{{ $i }}"  @if ($data['usia1'] == $i)
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
                                                <option value="{{ $i }}"  @if ($data['usia2'] == $i)
                                                selected
                                            @endif>{{ $i }} Tahun</option>
                                            @endfor
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                
                            </div>
                        </form>
                      </div>
                        @forelse ($data['anggota'] as $item)
                            <div class="col-md-2">
                                <div class="card w-100">
                                    <a href="{{ url('/orang/'.Crypt::encryptString($item->orang_id))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img-top" alt="..."></a>
                                    <div class="card-body p-1 text-center">
                                    <small class="text-capitalize">{{ fullname($item)}}</small>
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
@if (!is_null($data['grup']))
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('/grupanggota')}}" method="post">
                @csrf
                <input type="hidden" name="grup_id" value="{{ $data['grup']->id }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Anggota Grup</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                <div class="form-group row">
                    <label for="" class="col-md-4">Nama Anggota</label>
                    <select name="orang_id" id="orang_id" class="form-control col-md-8">
                        @foreach ($orang as $item)
                            @if (!DbChatomz::cekstatusgrup($data['grup']->id,$item->id))
                                <option value="{{ $item->id}}">{{ fullname($item)}}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="information" id="information" class="form-control col-md-8">
                </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
            </div>
        </form>
        </div>
        </div>
    </div>
@endif

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
