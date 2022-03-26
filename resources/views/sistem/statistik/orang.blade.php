<x-singel-layout title="CHATOMZ - STATISTIK" back="orang">
    <x-slot name="content">
        <div class="card">
            <div class="card-header">
                <h3 class="text-capitalize">Statisik Analisis</h3>
                <p>{{ $judul ?? '' }}
                {{-- <span class="badge bg-info float-end">Total {{ count($orang) }}</span> --}}
                </p>
            </div>
            <div class="card-body">
                {{-- <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 text-left">
                        <x-tombolstatistik teks="jenis kelamin" :s="$s" ds="jk"/>
                        <x-tombolstatistik teks="fase kehidupan manusia" :s="$s" ds="fasemanusia"/>
                        <x-tombolstatistik teks="kelengkapan data" :s="$s" ds="biodata"/>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-6">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach ($data as $j => $d)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if ($loop->iteration == 1)
                                    active
                                    @endif" id="{{ $loop->iteration }}-tab" data-bs-toggle="tab" href="#tab{{ $loop->iteration }}"
                                        role="tab" aria-controls="tab{{ $loop->iteration }}" aria-selected="true">{{ $j }} <span class="badge bg-primary">{{ count($d) }}</span></a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @foreach ($data as $j => $d)
                                <div class="tab-pane fade @if ($loop->iteration == 1)
                                    show active
                                    @endif" id="tab{{ $loop->iteration }}" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row d-flex align-items-stretch mt-4">
                                        @forelse ($d as $item)
                                            <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                                                <div class="card mb-3 w-100">
                                                    <div class="row no-gutters">
                                                    <div class="col-md-4">
                                                        <a href="{{ url('/orang/'.Crypt::encryptString($item->id))}}" target="_blank">
                                                            <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                                                        </a>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body p-0">
                                                        <h6 class="card-title" style="font-size: 14px">
                                                            {{ fullname($item)}} 
                                                            @if ($item->gender == 'laki-laki')
                                                                    <sup><i class="fas fa-mars text-primary"></i></sup>  
                                                                @else
                                                                    <sup><i class="fas fa-venus text-danger"></i></sup>  
                                                                @endif
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#ubah" data-id="{{ $item->id }}" data-date_birth="{{ $item->date_birth }}" data-gender="{{ $item->gender }}" data-note="{{ $item->note }}" data-marital_status="{{ $item->marital_status }}" data-status_group="{{ $item->status_group }}" data-home_address="{{ $item->home_address }}" data-place_birth="{{ $item->place_birth }}" data-blood_type="{{ $item->blood_type }}" data-death="{{ $item->death }}" ><i class="bi-pencil float-end text-success"></i></a>
                                                        </h6>
                                                        <small style="font-size: 11px">{{ $item->home_address }}</small>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col text-center">
                                                <i>Data tidak ada</i>
                                            </div>
                                        @endforelse
                                    </div>                                 
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="kelengkapandata-tab" data-bs-toggle="pill"
                                href="#kelengkapandata" role="tab" aria-controls="kelengkapandata"
                                aria-selected="true">Kelengkapan Data</a>
                            <a class="nav-link" id="fasekehidupan-tab" data-bs-toggle="pill"
                                href="#fasekehidupan" role="tab" aria-controls="fasekehidupan"
                                aria-selected="false">Fase Kehidupan</a>
                            {{-- <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                aria-selected="false">Messages</a>
                            <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                aria-selected="false">Settings</a> --}}
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="kelengkapandata" role="tabpanel"
                                aria-labelledby="kelengkapandata-tab">
                                <section>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach ($data['kelengkapandata'] as $j => $d)
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link @if ($loop->iteration == 1)
                                                active
                                                @endif" id="{{ $loop->iteration }}-tab" data-bs-toggle="tab" href="#tab{{ $loop->iteration }}"
                                                    role="tab" aria-controls="tab{{ $loop->iteration }}" aria-selected="true">{{ $j }} <span class="badge bg-primary">{{ count($d) }}</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        @foreach ($data['kelengkapandata'] as $j => $d)
                                            <div class="tab-pane fade @if ($loop->iteration == 1)
                                                show active
                                                @endif" id="tab{{ $loop->iteration }}" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row d-flex align-items-stretch mt-4">
                                                    @forelse ($d as $item)
                                                        <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                                                            <div class="card mb-3 w-100">
                                                                <div class="row no-gutters">
                                                                <div class="col-md-4">
                                                                    <a href="{{ url('/orang/'.Crypt::encryptString($item->id))}}" target="_blank">
                                                                        <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body p-0">
                                                                    <h6 class="card-title" style="font-size: 14px">
                                                                        {{ fullname($item)}} 
                                                                        @if ($item->gender == 'laki-laki')
                                                                                <sup><i class="fas fa-mars text-primary"></i></sup>  
                                                                            @else
                                                                                <sup><i class="fas fa-venus text-danger"></i></sup>  
                                                                            @endif
                                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#ubah" data-id="{{ $item->id }}" data-date_birth="{{ $item->date_birth }}" data-gender="{{ $item->gender }}" data-note="{{ $item->note }}" data-marital_status="{{ $item->marital_status }}" data-status_group="{{ $item->status_group }}" data-home_address="{{ $item->home_address }}" data-place_birth="{{ $item->place_birth }}" data-blood_type="{{ $item->blood_type }}" data-death="{{ $item->death }}" ><i class="bi-pencil float-end text-success"></i></a>
                                                                    </h6>
                                                                    <small style="font-size: 11px">{{ $item->home_address }}</small>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col text-center">
                                                            <i>Data tidak ada</i>
                                                        </div>
                                                    @endforelse
                                                </div>                                 
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="fasekehidupan" role="tabpanel"
                                aria-labelledby="fasekehidupan-tab">
                                <section>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach ($data['fasekehidupan'] as $j => $d)
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link @if ($loop->iteration == 1)
                                                active
                                                @endif" id="{{ $loop->iteration }}-tab" data-bs-toggle="tab" href="#fase{{ $loop->iteration }}"
                                                    role="tab" aria-controls="fase{{ $loop->iteration }}" aria-selected="true">{{ $j }} <span class="badge bg-primary">{{ count($d) }}</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        @foreach ($data['fasekehidupan'] as $j => $d)
                                            <div class="tab-pane fade @if ($loop->iteration == 1)
                                                show active
                                                @endif" id="fase{{ $loop->iteration }}" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row d-flex align-items-stretch mt-4">
                                                    @forelse ($d as $item)
                                                        <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                                                            <div class="card mb-3 w-100">
                                                                <div class="row no-gutters">
                                                                <div class="col-md-4">
                                                                    <a href="{{ url('/orang/'.Crypt::encryptString($item->id))}}" target="_blank">
                                                                        <img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img" alt="...">
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body p-0">
                                                                    <h6 class="card-title" style="font-size: 14px">
                                                                        {{ fullname($item)}} 
                                                                        @if ($item->gender == 'laki-laki')
                                                                                <sup><i class="fas fa-mars text-primary"></i></sup>  
                                                                            @else
                                                                                <sup><i class="fas fa-venus text-danger"></i></sup>  
                                                                            @endif
                                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#ubah" data-id="{{ $item->id }}" data-date_birth="{{ $item->date_birth }}" data-gender="{{ $item->gender }}" data-note="{{ $item->note }}" data-marital_status="{{ $item->marital_status }}" data-status_group="{{ $item->status_group }}" data-home_address="{{ $item->home_address }}" data-place_birth="{{ $item->place_birth }}" data-blood_type="{{ $item->blood_type }}" data-death="{{ $item->death }}" ><i class="bi-pencil float-end text-success"></i></a>
                                                                    </h6>
                                                                    <small style="font-size: 11px">{{ $item->home_address }}</small>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col text-center">
                                                            <i>Data tidak ada</i>
                                                        </div>
                                                    @endforelse
                                                </div>                                 
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                aria-labelledby="v-pills-messages-tab">
                                Integer pretium dolor at sapien laoreet ultricies. Fusce congue et
                                lorem id
                                convallis. Nulla volutpat tellus nec
                                molestie finibus. In nec odio tincidunt eros finibus ullamcorper. Ut
                                sodales,
                                dui nec posuere finibus, nisl sem aliquam
                                metus, eu accumsan lacus felis at odio.
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                aria-labelledby="v-pills-settings-tab">
                                Sed lacus quam, convallis quis condimentum ut, accumsan congue
                                massa.
                                Pellentesque et quam vel massa pretium ullamcorper
                                vitae eu tortor.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- ubah anggota grup --}}
    <x-modalubah judul="Edit Orang" link="orang" size="modal-lg">
        <input type="hidden" name="perbaharui" value="TRUE">
        <section class="p-3 row">
            <div class="col">
                <div class="form-group">
                    <label for="inlineinput">Alamat Rumah</label>
                        <textarea name="home_address" id="home_address" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Tempat Lahir</label>
                        <input type="text" name="place_birth" class="form-control" id="place_birth">
                </div>
                <div class="form-group">
                    <label for="inlineinput">Tanggal Lahir</label>
                        <input type="date" name="date_birth" class="form-control" id="date_birth">
                </div>
                <div class="form-group">
                    <label for="inlineinput">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="laki-laki">Laki - laki</option>
                            <option value="perempuan">Perempuan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Golongan Darah</label>
                        <select name="blood_type" id="blood_type" class="form-control">
                            @foreach (kingdom_goldar() as $item)
                            <option value="{{ $item}}">{{ strtoupper($item)}}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="inlineinput">Status Perkawinan</label>
                        <select name="marital_status" id="marital_status" class="form-control">
                            <option value="belum">Belum Kawin</option>
                            <option value="sudah">Sudah Kawin</option>
                            <option value="pernah">Pernah Kawin</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Grup Status</label>
                        <select name="status_group" id="status_group" class="form-control">
                            <option value="available">Tersedia</option>
                            <option value="full">Ditutup</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Status Kematian</label>
                        <select name="death" id="death" class="form-control">
                            <option value="">Masih Hidup</option>
                            <option value="alm">Meninggal</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Catatan</label>
                    <input type="text" name="note" class="form-control" id="note">
                </div>
                <div class="form-group">
                    <label for="inlineinput">Photo</label>
                        <input type="file" name="photo" class="form-control">
                        <span class="text-danger">input jika ingin mengubah photo</span>
                </div>
            </div>
        </section>
    </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var home_address = button.data('home_address')
                var place_birth = button.data('place_birth')
                var date_birth = button.data('date_birth')
                var gender = button.data('gender')
                var death = button.data('death')
                var status_group = button.data('status_group')
                var note = button.data('note')
                var blood_type = button.data('blood_type')
                var marital_status = button.data('marital_status')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #home_address').val(home_address);
                modal.find('.modal-body #place_birth').val(place_birth);
                modal.find('.modal-body #date_birth').val(date_birth);
                modal.find('.modal-body #gender').val(gender);
                modal.find('.modal-body #death').val(death);
                modal.find('.modal-body #status_group').val(status_group);
                modal.find('.modal-body #note').val(note);
                modal.find('.modal-body #blood_type').val(blood_type);
                modal.find('.modal-body #marital_status').val(marital_status);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>

</x-singel-layout>
