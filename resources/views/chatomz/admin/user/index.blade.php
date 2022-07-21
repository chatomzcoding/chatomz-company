<x-mazer-layout title="CHATOMZ - Data User" datatables="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data User" active="Daftar User">
            </x-header>
            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <x-sistem.tambah></x-sistem.tambah>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Aksi</th>
                                            <th>Photo</th>
                                            <th>Nama User</th>
                                            <th>Email</th>
                                            <th>Level</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        @forelse ($user as $item)
                                        <tr>
                                                <td class="text-center">{{ $loop->iteration}}</td>
                                                <td class="text-center">
                                                    <x-aksi :id="$item->id" link="user">
                                                        <a href="{{ url('kategori/'.$item->id) }}" class="dropdown-item text-primary"><i class="fas fa-file" style="width: 20px;"></i> DETAIL</a>
                                                        <button type="button" data-bs-toggle="modal"  data-name="{{ $item->name }}"  data-level="{{ $item->level }}"  data-email="{{ $item->email }}" data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                            <i class="fa fa-edit" style="width: 20px;"></i> EDIT
                                                        </button>
                                                    </x-aksi>
                                                </td>
                                                <td><img src="{{ asset('img/user/'.$item->photo)}}" alt="{{ $item->photo}}" width="100px"></td>
                                                <td>{{ $item->name}}</td>
                                                <td>{{ $item->email}}</td>
                                                <td>{{ $item->level}}</td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4">tidak ada data</td>
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
        <x-modalubah judul="ubah data user" link="subkategori">
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
                    <input type="password" name="password" id="password" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="">Ulangi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Photo (jika ingin diubah)</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var name = button.data('name')
                var level = button.data('level')
                var email = button.data('email')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #level').val(level);
                modal.find('.modal-body #email').val(email);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
