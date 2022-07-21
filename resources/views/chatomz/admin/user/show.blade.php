<x-mazer-layout title="CHATOMZ - Data User" datatables="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data User" active="Detail User">
            </x-header>
            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <x-sistem.kembali url="user"></x-sistem.kembali>
                            <x-sistem.tambah></x-sistem.tambah>
                        </div>
                        <div class="card-body">
                            <h3>Daftar Orang Akses</h3>
                            <div class="table-responsive">
                                <table id="example1" class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Aksi</th>
                                            <th>Photo</th>
                                            <th>Nama</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        @forelse ($user->orangakses as $item)
                                        <tr>
                                                <td class="text-center">{{ $loop->iteration}}</td>
                                                <td class="text-center">
                                                    <x-aksi :id="$item->id" link="user">
                                                        <a href="{{ url('orang/'.Crypt::encryptString($item->orang->id)) }}" class="dropdown-item text-primary"><i class="fas fa-file" style="width: 20px;"></i> DETAIL</a>
                                                    </x-aksi>
                                                </td>
                                                <td><img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->orang->photo))}}" width="150px"
                                                    alt="singleminded"></td>
                                                <td>{{ fullname($item->orang)}}</td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4">tidak ada data</td>
                                            </tr>
                                        @endforelse
                                </table>
                            </div>
                            <hr>
                            <h3>Daftar Keluarga Akses</h3>
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama keluarga</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        @forelse ($user->keluargaakses as $item)
                                        <tr>
                                                <td class="text-center">{{ $loop->iteration}}</td>
                                                <td>{{ $item->keluarga->nama_keluarga}}</td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="2">tidak ada data</td>
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
        {{-- modal --}}
        <x-modalsimpan judul="Tambah User" link="user">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama User" required>
                </div>
                <div class="form-group">
                    <label for="">email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Alamat Email" required>
                </div>
                <div class="form-group">
                    <label for="">Level</label>
                    <select name="level" id="level" class="form-control">
                        @foreach (list_leveluser() as $item)
                            <option value="{{ $item}}">{{ $item}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="********" required  autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="">Ulangi Password</label>
                    <input type="password" name="password_confirmation" id="password" class="form-control" placeholder="********" required>
                </div>
                <div class="form-group">
                    <label for="">Photo</label>
                    <input type="file" name="photo" id="profile_photo_path" class="form-control" required>
                </div>
            </section>
        </x-modalsimpan>
    </x-slot>
</x-mazer-layout>
