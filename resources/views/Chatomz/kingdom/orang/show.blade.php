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
                <li class="breadcrumb-item active">Detail {{ $orang->first_name.' '.$orang->last_name}}</li>
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
                            <span class="float-right"><a href="{{ url('orang',Crypt::encryptString($tombol['next']->id))}}">
                            <i class="fas fa-angle-right"></i></a></span><span class="float-right">&nbsp;&nbsp;&nbsp;</span>
                        @endif 
                        @if (!is_null($tombol['back']))
                        <span class="float-right"><a href="{{ url('orang',Crypt::encryptString($tombol['back']->id))}}"><i class="fas fa-angle-left"></i></a></span>
                        @endif
                    </div>
                </h4>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                    <section>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-post card-round">
                                    <a href="#" data-target="#ubahphoto" data-toggle="modal"><img class="card-img-top" src="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}" alt="Card image cap"></a>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="avatar">
                                                <a href="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($orang->photo))}}" width="50px" alt="..." class="avatar-img rounded-circle"></a>
                                            </div>
                                            <div class="info-post ml-2">
                                                <p class="username text-capitalize">{{ $orang->job_status}}</p>
                                                <p class="date text-muted">{{ age($orang->date_birth,'Bulan')}}</p>
                                            </div>
                                        </div>
                                        <div class="separator-solid"></div>
                                        {{-- <p class="card-category text-info mb-1">Quick Access</p> --}}
                                        <h3 class="card-title">
                                            <p class="demo">
                                                <form id="data-{{ $orang->id }}" action="{{url('/orang/'.$orang->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    </form>
                                                    <button onclick="deleteRow( {{ $orang->id }} )" class="btn btn-icon btn-round btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                <a href="{{ url('orang/'.Crypt::encryptString($orang->id).'/edit')}}" style="display: inline;">
                                                    <button type="button" class="btn btn-icon btn-round btn-success">
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
                                                    <a href="#" data-toggle="modal" data-target="#addreminder">
                                                        <button type="button" class="btn btn-icon btn-round btn-success">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                                <a href="#" data-toggle="modal" data-target="#keluarga">
                                                    <button type="button" class="btn btn-icon btn-round btn-secondary">
                                                        <i class="fas fa-sitemap"></i>
                                                    </button>
                                                </a>
                                            </p>
                                        </h3>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true"><i class="far fa-user"></i><strong> | PROFIL</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-phone"></i> | <strong>KONTAK</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab" aria-controls="pills-contact-nobd" aria-selected="false"><i class="fas fa-user-graduate"></i> | <strong>PENDIDIKAN</strong> </a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                                        <table class="table mt-3">
                                            <tbody class="text-capitalize">
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>{{ $orang->home_address}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Lahir</th>
                                                    <td>{{ $orang->place_birth.', '.date_indo($orang->date_birth)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Agama</th>
                                                    <td>{{ $orang->religion}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status Perkawinan</th>
                                                    <td>{{ $orang->marital_status}} Kawin</td>
                                                </tr>
                                                <tr>
                                                    <th>Golongan Darah</th>
                                                    <td>{{ $orang->blood_type}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kebangsaan</th>
                                                    <td>{{ $orang->nasionality}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
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
                                    <div class="tab-pane fade" id="pills-contact-nobd" role="tabpanel" aria-labelledby="pills-contact-tab-nobd">
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
                                </div>
                            </div>
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
                    @foreach ($keluarga as $item)
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
    <!-- /.modal -->

    {{-- modal edit --}}
    {{-- <div class="modal fade" id="ubah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('orang.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Klasifikasi Surat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4">Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control col-md-8" required>
                   </div>
                   <div class="form-group row">
                        <label for="" class="col-md-4">Status</label>
                        <select name="status" id="status" class="form-control col-md-8">
                            @foreach (list_status() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
                        </select>
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
    </div> --}}
    <!-- /.modal -->

    @section('script')
        
        {{-- <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama = button.data('nama')
                var kode = button.data('kode')
                var keterangan = button.data('keterangan')
                var status = button.data('status')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #kode').val(kode);
                modal.find('.modal-body #keterangan').val(keterangan);
                modal.find('.modal-body #status').val(status);
                modal.find('.modal-body #id').val(id);
            })
        </script> --}}
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
