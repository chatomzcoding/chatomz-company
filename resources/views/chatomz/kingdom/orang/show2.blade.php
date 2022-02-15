@section('title')
    CHATOMZ - Detail Orang
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
                <li class="breadcrumb-item"><a href="{{ url('orang')}}">Daftar Orang</a></li>
                <li class="breadcrumb-item active">Detail</li>
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
                <h4 class="card-title text-capitalize w-100">{{ fullname($orang)}} 
                    @if ($orang->gender == 'laki-laki')
                        <sup><i class="fas fa-mars text-primary"></i></sup>  
                    @else
                        <sup><i class="fas fa-venus text-danger"></i></sup>  
                    @endif
                    
                    <div class="float-right">
                        @if (!is_null($tombol['next']))
                            <span class="float-right"><a href="{{ url('orang',Crypt::encryptString($tombol['next']->id))}}" data-toggle="tooltip" title="selanjutnya">
                            <i class="fas fa-angle-right"></i></a></span><span class="float-right">&nbsp;&nbsp;&nbsp;</span>
                        @endif 
                        @if (!is_null($tombol['back']))
                        <span class="float-right"><a href="{{ url('orang',Crypt::encryptString($tombol['back']->id))}}"  data-toggle="tooltip" title="sebelumnya"><i class="fas fa-angle-left"></i></a></span>
                        @endif
                    </div>
                </h4>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                    <section>
                        <div class="row">
                            <div class="col-md-3">
                  
                              <!-- Profile Image -->
                              <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                  <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}"
                                         alt="User profile picture">
                                  </div>
                  
                                  <h3 class="profile-username text-center">{{ fullname($orang) }}</h3>
                  
                                  <p class="text-muted text-center">{{ $orang->job_status }}</p>
                  
                                  <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                      <b>Grup</b> <a class="float-right">{{ count($anggotagrup) }}</a>
                                    </li>
                                    <li class="list-group-item">
                                      <b>Usia</b> <a class="float-right">{{ age($orang->date_birth,'Bulan')}}</a>
                                    </li>
                                  </ul>
                  
                                  {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                                  <p class="demo text-center">
                                    <form id="data-{{ $orang->id }}" action="{{url('/orang/'.$orang->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        </form>
                                        <button onclick="deleteRow( {{ $orang->id }} )" class="btn btn-icon btn-round btn-danger pop-info" title="hapus orang"><i class="fas fa-trash-alt"></i></button>
                                    <a href="{{ url('orang/'.Crypt::encryptString($orang->id).'/edit')}}" style="display: inline;">
                                        <button type="button" class="btn btn-icon btn-round btn-success pop-info" title="Edit Orang">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </a>
                                    @if (Auth::user()->level == 'admin')
                                        {{-- <a href="#" data-toggle="modal" data-target="#addRowModal" class=" notif-block">
                                            <button type="button" class="btn btn-icon btn-round btn-success">
                                                <i class="fas fa-address-book"></i>
                                            </button>
                                            <span class="{{ bgaddgroupicon($orang->status_group)}}">{{ count($groups) }}</span>
                                        </a> --}}
                                        <a href="#" data-toggle="modal" data-target="#grup">
                                            <button type="button" class="btn btn-icon btn-round btn-info pop-info" title="anggota grup">
                                                <i class="far fa-id-card"></i>
                                            </button>
                                        </a>
                                    @endif
                                    @if ($orang->marital_status == 'sudah' || count($keluarga) > 0)
                                        <a href="#" data-toggle="modal" data-target="#keluarga">
                                            <button type="button" class="btn btn-icon btn-round btn-secondary pop-info" title="lihat silsilah keluarga">
                                                <i class="fas fa-sitemap"></i>
                                            </button>
                                        </a>
                                        @endif
                                    <a href="#" data-toggle="modal" data-target="#linimasa">
                                        <button type="button" class="btn btn-icon btn-round bg-indigo pop-info" title="tambah lini masa">
                                            <i class="fas fa-stream"></i>
                                        </button>
                                    </a>
                                </p>
                                </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                  
                              <!-- About Me Box -->
                              <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title">Tentang</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <strong><i class="fas fa-address-book"></i> Alamat</strong>
                  
                                  <p class="text-muted">
                                    {{ $orang->home_address }}
                                  </p>
                  
                                  <hr>
                  
                                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Tempat Lahir</strong>
                  
                                  <p class="text-muted">{{ $orang->place_birth.', '.date_indo($orang->date_birth)}}</p>
                  
                                  <hr>
                  
                                  <strong><i class="fas fa-pray"></i> Agama</strong>
                  
                                  <p class="text-muted">
                                    {{ $orang->religion}}
                                    {{-- <span class="tag tag-primary">Node.js</span> --}}
                                  </p>
                  
                                  <hr>
                                  <strong><i class="fas fa-heart mr-1"></i> Status Perkawinan</strong>
                  
                                  <p class="text-muted">
                                    {{ $orang->marital_status}}
                                    {{-- <span class="tag tag-primary">Node.js</span> --}}
                                </p>
                                
                                <hr>
                                
                                <strong><i class="far fa-file-alt mr-1"></i> Catatan</strong>
                                
                                <p class="text-muted">{{ $orang->note }}</p>
                            </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                              <div class="card">
                                  <div class="card-header p-2">
                                      <ul class="nav nav-pills">
                                          <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                                          <li class="nav-item"><a class="nav-link" href="#kontak" data-toggle="tab">Kontak</a></li>
                                          <li class="nav-item"><a class="nav-link" href="#pendidikan" data-toggle="tab">Pendidikan</a></li>
                                          <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <!-- /.tab-pane -->
                                            <div class="active tab-pane" id="timeline">
                                              <!-- The timeline -->
                                              <div class="timeline timeline-inverse">
                                                <!-- timeline time label -->
                                                <div class="time-label">
                                                  <span class="bg-danger">
                                                    Februari 2022
                                                  </span>
                                                </div>
                                                <!-- /.timeline-label -->
                                                @forelse ($linimasa as $item)
                                                    <!-- timeline item -->
                                                    <div>
                                                    <i class="fas fa-{{ linimasa_icon($item->icon) }} bg-primary"></i>
                                                    <div class="timeline-item">
                                                        <span class="time text-white"><i class="far fa-clock"></i> {{ date_indo($item->tanggal).' '.$item->jam }}</span>
                            
                                                        <h3 class="timeline-header bg-navy"><a href="#">{{ ucwords($item->nama) }}</a></h3>
                            
                                                        <div class="timeline-body">
                                                        {{ $item->keterangan }}
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <span class="font-italic">{{ $item->tag }}</span> 
                                                            <button type="button" data-toggle="modal"  data-nama="{{ $item->nama }}"  data-keterangan="{{ $item->keterangan }}"  data-icon="{{ $item->icon }}" data-tanggal="{{ $item->tanggal }}" data-jam="{{ $item->jam }}" data-tag="{{ $item->tag }}" data-id="{{ $item->id }}" data-target="#ubahlinimasa" title="" class="float-right btn btn-success btn-sm" data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- END timeline item -->
                                                @empty
                                                <div>
                                                    <i class="far fa-clock bg-gray"></i>
                                                  </div>
                                                @endforelse
                                              </div>
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="kontak">
                                        @if (is_null($kontak))
                                            <div class="text-center m-3 p-3">
                                                <p><i> Data kontak belum ada </i></p>
                                                <a href="#" class="btn btn-secondary btn-sm" data-target="#tambahkontak" data-toggle="modal"><i class="fa fa-plus bg-white rounded-circle text-secondary p-1"></i> tambahkan</a>
                                            </div>
                                        @else
                                            <table class="table mt-3">
                                                <tbody>
                                                    @if (!is_null($kontak->no_hp))
                                                        <tr>
                                                            <th>No. Handphone</th>
                                                            <td>{{ $kontak->no_hp}}</td>
                                                        </tr>
                                                    @endif
                                                    @if (!is_null($kontak->no_tel))
                                                        <tr>
                                                            <th>No. Telepon</th>
                                                            <td>{{ $kontak->no_tel}}</td>
                                                        </tr>
                                                    @endif
                                                    @if (!is_null($kontak->no_wa))
                                                        <tr>
                                                            <th>No. Whatsapp</th>
                                                            <td>{{ $kontak->no_wa}}</td>
                                                        </tr>
                                                    @endif
                                                    @if (!is_null($kontak->email))
                                                        <tr>
                                                            <th>E-mail</th>
                                                            <td class="text-lowercase">{{ $kontak->email}}</td>
                                                        </tr>
                                                    @endif
                                                    @if (!is_null($kontak->office_email))
                                                        <tr>
                                                            <th>E-mail Office</th>
                                                            <td class="text-lowercase">{{ $kontak->office_email}}</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <th>Social Media</th>
                                                        <td>
                                                            @if (!is_null($kontak->fb))
                                                                <a href="{{ $kontak->fb}}" target="_blank" class="{{ linkDisabled($kontak->fb) }}"><i class="fab fa-facebook-square fa-2x"></i></a>&nbsp;
                                                            @endif
                                                            @if (!is_null($kontak->tw))
                                                                <a href="{{ $kontak->tw}}" target="_blank" class="{{ linkDisabled($kontak->tw) }}"><i class="fab fa-twitter-square fa-2x"></i></a>&nbsp;
                                                            @endif
                                                            @if (!is_null($kontak->ig))
                                                                <a href="{{ $kontak->ig}}" target="_blank" class="{{ linkDisabled($kontak->ig) }}"><i class="fab fa-instagram fa-2x"></i></a> &nbsp;
                                                            @endif
                                                            @if (!is_null($kontak->line))
                                                                <a href="{{ $kontak->line}}" target="_blank" class="{{ linkDisabled($kontak->link) }}"><i class="fab fa-line fa-2x"></i></a> 
                                                            @endif
                                                            </td>
                                                    </tr>
                                                    @if (!is_null($kontak->web))
                                                        <tr>
                                                            <th>Website</th>
                                                            <td><a href="{{ '/'.$kontak->web}}" target="_blank">{{ $kontak->web}}</a> </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="2" class="text-right">
                                                            <a href="{{ url('/kontak/'.Crypt::encryptString($kontak->id).'/edit')}}" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> EDIT KONTAK</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="pendidikan">
                                        @if (is_null($pendidikan))
                                        <div class="text-center m-3 p-3">
                                            <p class="font-italic">Data pendidikan belum tersedia</p>
                                            <a href="#" class="btn btn-secondary btn-sm" data-target="#tambahpendidikan" data-toggle="modal"><i class="fa fa-plus bg-white rounded-circle text-secondary p-1"></i>  tambahkan</a>
                                        </div>
                                    @else
                                        <table class="table mt-3">
                                            <tbody class="text-capitalize">
                                                @if (!is_null($pendidikan->tk))
                                                    <tr>
                                                        <th>TA / TPA</th>
                                                        <td class="text-uppercase">{{ $pendidikan->tk}}</td>
                                                    </tr>
                                                @endif
                                                @if (!is_null($pendidikan->sd))
                                                <tr>
                                                    <th>SD</th>
                                                    <td class="text-uppercase">{{ $pendidikan->sd}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->smp))
                                                <tr>
                                                    <th>SMP/MTS</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->smp}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->sma))
                                                <tr>
                                                    <th>SMA/SMK/MA</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->sma}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->d))
                                                <tr>
                                                    <th>Diploma</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->d}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->s1))
                                                <tr>
                                                    <th>S1</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->s1}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->s2))
                                                <tr>
                                                    <th>S2</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->s2}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->s3))
                                                <tr>
                                                    <th>S3</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->s3}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->pesantren))
                                                <tr>
                                                    <th>Pesantren</th>
                                                    <td  class="text-uppercase">{{ $pendidikan->pesantren}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->homescholl))
                                                <tr>
                                                    <th>Home Scholling</th>
                                                    <td class="text-lowercase">{{ $pendidikan->homescholl}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->boardingscholl))
                                                <tr>
                                                    <th>Boarding Scholling</th>
                                                    <td class="text-lowercase">{{ $pendidikan->boardingscholl}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->bimbel))
                                                <tr>
                                                    <th>Bimbel</th>
                                                    <td class="text-lowercase">{{ $pendidikan->bimbel}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->kursus))
                                                <tr>
                                                    <th>Kursus</th>
                                                    <td class="text-lowercase">{{ $pendidikan->kursus}}</td>
                                                </tr>
                                                @endif
                                                @if (!is_null($pendidikan->information))
                                                <tr>
                                                    <th>Information</th>
                                                    <td class="text-lowercase">{{ $pendidikan->information}}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="2" class="text-right">
                                                        <a href="{{ url('/pendidikan/'.Crypt::encryptString($pendidikan->id).'/edit')}}" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> EDIT PENDIDIKAN</a>
                                                    </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    @endif
                                    </div>
                  
                                    <div class="tab-pane" id="settings">
                                        setting
                                    </div>
                                    <!-- /.tab-pane -->
                                  </div>
                                  <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                            </div>
                            <!-- /.col -->
                          </div>
                    </section>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- modal --}}
    {{-- modal tambah --}}
    <div class="modal fade" id="tambahpendidikan">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/pendidikan')}}" method="post">
                @csrf
                <input type="hidden" name="orang_id" value="{{ $orang->id }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Pendidikan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small small">TK/TPA</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="tk">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">SD</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="sd">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">SMP/MTS</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="smp">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">SMA/SMK/MA</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="sma">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Jenjang Diploma</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="d">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Jenjang S1</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="s1">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Jenjang S2</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="s2">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Jenjang S3</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="s3">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Pesantren</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="pesantren">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Sekolah Dirumah</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="homescholl">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Boarding Scholl</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="boardingscholl">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Bimbingan Belajar</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="bimbel">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Kursus</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="kursus">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Informasi Singkat</label>
                                <textarea name="information" id="" cols="30" rows="4" class="form-control col-md-8"></textarea>
                            </div>
                        </div>
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

    <div class="modal fade" id="tambahkontak">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/kontak')}}" method="post">
                @csrf
                <input type="hidden" name="orang_id" value="{{ $orang->id }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Kontak</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">No Telepon Seluler</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="no_hp" placeholder="input number phone celluler">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">No Telepon Rumah</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="no_tel" placeholder="input number phone home">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">No Whatsapp</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="no_wa" placeholder="input number whatsapp">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">No Telepon Kantor</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="no_office" placeholder="input number office phone">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Alamat E-mail</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="email" placeholder="input email address">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Alamat E-mail Kantor</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="office_email" placeholder="input email office address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Link Facebook</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="fb" placeholder="input link facebook">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Link Twitter</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="tw" placeholder="input link twitter">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Link Instagram</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="ig" placeholder="input link instagram">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Website</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="web" placeholder="input website">
                            </div>
                            <div class="row form-group">
                                <label for="" class="col-md-4 pt-2 small">Line</label>
                                <input type="text" class="form-control form-control-sm col-md-8" name="line" placeholder="input account line">
                            </div>
                        </div>
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
    <div class="modal fade" id="keluarga">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Riwayat Keluarga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="row p-3">
                    @if (count($suami) > 0)
                        @foreach ($suami as $item)
                        <div class="col-md-6">
                            <div class="card bg-info">
                                <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-2">
                                    <small class="text-capitalize">{{ fullname($orang)}}
                                        <br>
                                    <i>Kepala Keluarga</i> | {{ $item->nama_keluarga }}</small> <br>
                                    <a href="{{ url('/keluarga/'.Crypt::encryptString($item->id)) }}" class="btn btn-outline-light btn-sm">Lihat Keluarga</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        {{-- jika laki laki dan sudah kawin maka munculkan tambahkan keluarga --}}
                        @if ($orang->gender == 'laki-laki' AND $orang->marital_status == 'sudah')
                        <section class="col-md-12 text-center">
                            <small class="font-italic">Memenuhi syarat menjadi kepala keluarga</small> <br>
                            {{-- <a href="{{ url('/keluarga/create') }}" class="btn btn-primary btn-sm">Tambahkan keluarga baru</a> --}}
                            <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-sm">Tambahkan keluarga baru</a>
                        </section>
                        @endif
                    @endif

                    @if (count($keluarga) == 0)
                        @if ($orang->gender == 'perempuan' AND $orang->marital_status == 'sudah')
                            <section class="col-md-12 text-center">
                                <small class="font-italic">Memenuhi syarat menjadi seorang istri</small> <br>
                                <a href="#" data-toggle="modal" data-target="#tambahkeluarga" class="btn btn-primary btn-sm">Tambahkan keluarga</a>
                            </section>
                        @endif
                    @endif
                  
                    @foreach ($keluarga as $item)
                    @if ($item->status == 'istri')
                        <div class="col-md-6">
                            <div class="card bg-success">
                                <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-2">
                                    <small class="text-capitalize">{{ fullname($item)}}
                                        <br>
                                    <i>{{ $item->status }}</i> | {{ $item->nama_keluarga }}</small> <br>
                                    <a href="{{ url('/keluarga/'.Crypt::encryptString($item->keluarga_id)) }}" class="btn btn-outline-light btn-sm">Lihat Keluarga</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($item->status == 'anak')
                        <div class="col-md-6">
                            <div class="card">
                                <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-2">
                                    <small class="text-capitalize">{{ fullname($item)}}
                                        <br>
                                    <i>{{ $item->status .' - '. $item->urutan }}</i> | {{ $item->nama_keluarga }}</small> <br>
                                    <a href="{{ url('/keluarga/'.Crypt::encryptString($item->keluarga_id)) }}" class="btn btn-outline-success btn-sm">Lihat Keluarga</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                @endforeach
                </section>
            </div>
            <div class="modal-footer text-right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            {{-- <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button> --}}
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/keluarga')}}" method="post">
                @csrf
                <input type="hidden" name="orang_id" value="{{ $orang->id }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Keluarga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Keluarga</label>
                        <input type="text" name="nama_keluarga" id="nama_keluarga" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">No KK</label>
                        <input type="text" name="no_kk" id="no_kk" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tanggal Pernikahan</label>
                        <input type="date" name="tgl_pernikahan" id="tgl_pernikahan" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Status Keluarga</label>
                        <select name="status_keluarga" id="status_keluarga" class="form-control col-md-8">
                            @foreach (kingdom_statuskeluarga() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
                        </select>
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

    <div class="modal fade" id="ubahlinimasa">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('linimasa.update','test')}}" method="post">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Lini Masa</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" id="id" name="id">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tanggal {!! ireq() !!}</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Jam</label>
                        <input type="time" name="jam" id="jam" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Lini Masa {!! ireq() !!}</label>
                        <input type="text" name="nama" id="nama" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan {!! ireq() !!}</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control col-md-8" required></textarea>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Icon</label>
                        <input type="text" name="icon" id="icon" value="calendar" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tag</label>
                        <input type="text" name="tag" id="tag" class="form-control col-md-8">
                   </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    <div class="modal fade" id="linimasa">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/linimasa')}}" method="post">
                @csrf
                <input type="hidden" name="orang_id" value="{{ $orang->id }}">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Lini Masa</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tanggal {!! ireq() !!}</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Jam</label>
                        <input type="time" name="jam" id="jam" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama Lini Masa {!! ireq() !!}</label>
                        <input type="text" name="nama" id="nama" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan {!! ireq() !!}</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control col-md-8" required></textarea>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Icon</label>
                        <input type="text" name="icon" id="icon" value="calendar" class="form-control col-md-8">
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Tag</label>
                        <input type="text" name="tag" id="tag" class="form-control col-md-8">
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
    <div class="modal fade" id="tambahkeluarga">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/keluargahubungan')}}" method="post">
                @csrf
                <input type="hidden" name="orang_id" value="{{ $orang->id }}">
                <input type="hidden" name="status" value="istri">
                <input type="hidden" name="urutan" value="1">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Keluarga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                         <label for="" class="col-md-4">Daftar Keluarga</label>
                         <select name="keluarga_id" id="keluarga_id" class="form-control col-md-8">
                             @foreach ($daftarkeluarga as $item)
                                 <option value="{{ $item->id}}">{{ $item->nama_keluarga}}</option>
                             @endforeach
                         </select>
                    </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8">
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
    <div class="modal fade" id="grup">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Anggota Grup</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="row p-2">
                   @foreach ($anggotagrup as $item)
                   <div class="col-md-4">
                    <div class="card">
                        <a href="{{ url('grup/'.Crypt::encryptString($item->grup_id))}}"><img src="{{ asset('/img/chatomz/grup/'.$item->photo)}}" class="card-img-top" alt="..."></a>
                        <div class="card-body p-1 text-center">
                          <p class="small text-capitalize">{{ $item->name}}</p>
                          <small class="text-muted">{{ $item->information }}</small>
                        </div>
                        <div class="card-footer">
                            <form id="data-{{ $item->id }}" action="{{url('/grupanggota',$item->id)}}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                            <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-outline-danger btn-sm float-right mx-1"><i class="fas fa-trash-alt"></i></button>
                            <button type="button" data-toggle="modal"  data-information="{{ $item->information }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="btn btn-outline-success btn-sm float-right" data-original-title="Edit Task">
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                      </div>
                    </div>
                   @endforeach
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahgrup"><i class="fas fa-save"></i> TAMBAH GRUP</button>
            </div>
        </div>
        </div>
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="tambahgrup">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/grupanggota')}}" method="post">
                @csrf
                <input type="hidden" name="orang_id" value="{{ $orang->id }}">
                <input type="hidden" name="sesi" value="anggotalist">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Grup</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <p>ceklis bila ingin dimasukkan kedalam grup</p>
                    @foreach ($datagrup as $item)
                        @if (!DbChatomz::cekstatusgrup($item->id,$orang->id))
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <input type="checkbox" name="grup_id[]" value="{{ $item->id }}"> <span class="text-uppercase">{{ $item->name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="information[]" class="form-control" placeholder="masukkan informasi">
                                </div>
                            </div>
                        @endif
                    @endforeach
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

        {{-- modal edit --}}
        <div class="modal fade" id="ubah">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <form action="{{ route('grupanggota.update','test')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                <div class="modal-header">
                <h4 class="modal-title">Edit Anggota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body p-3">
                    <input type="hidden" name="id" id="id">
                    <section class="p-3">
                       <div class="form-group row">
                            <label for="" class="col-md-4">Keterangan</label>
                            <input type="text" name="information" id="information" class="form-control col-md-8">
                       </div>
                    </section>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        <!-- /.modal -->

    @section('script')
        
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var information = button.data('information')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #information').val(information);
                modal.find('.modal-body #id').val(id);
            })
        </script>
        <script>
            $('#ubahlinimasa').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama = button.data('nama')
                var keterangan = button.data('keterangan')
                var icon = button.data('icon')
                var tanggal = button.data('tanggal')
                var jam = button.data('jam')
                var tag = button.data('tag')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #keterangan').val(keterangan);
                modal.find('.modal-body #icon').val(icon);
                modal.find('.modal-body #tanggal').val(tanggal);
                modal.find('.modal-body #jam').val(jam);
                modal.find('.modal-body #tag').val(tag);
                modal.find('.modal-body #id').val(id);
            })
        </script>
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
