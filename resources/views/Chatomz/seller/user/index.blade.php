@section('title')
    Market - Data User
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">Daftar User</li>
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
              {{-- <div class="card-header">
                <h3 class="card-title">Daftar Unit</h3>
                <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah User Baru </a>
              </div> --}}
              <div class="card-body">
                  @include('sistem.notifikasi')
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                 <section>
                     <form action="{{ route('adminuser.update','test')}}" method="post" enctype="multipart/form-data">
                         @csrf
                         @method('patch')
                        <input type="hidden" name="id" value="{{ $user->id}}">
                        <input type="hidden" name="level" value="{{ $user->level}}">
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Nama </label>
                            <input type="text" name="name" id="name" class="form-control col-md-8" value="{{ $user->name}}" placeholder="Nama User" required>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">email</label>
                            <input type="text" name="email" id="email" class="form-control col-md-8" value="{{ $user->email}}" placeholder="Alamat Email" required>
                        </div>
                        <div class="callout callout-danger">
                            Jika tidak ingin merubah password, abaikan inputan <strong>Password & Ulangi Password</strong> tersebut !
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Password</label>
                            <input type="password" name="password" id="password" class="form-control col-md-8" autocomplete="off">
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Ulangi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control col-md-8">
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Photo (upload jika ingin diubah)</label>
                            <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control col-md-8">
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
                        </div>
                     </form>
                 </section>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- modal --}}
    {{-- modal tambah --}}
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('/adminuser')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
            <h4 class="modal-title">Tambah User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama </label>
                        <input type="text" name="name" id="name" class="form-control col-md-8" placeholder="Nama User" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">email</label>
                        <input type="text" name="email" id="email" class="form-control col-md-8" placeholder="Alamat Email" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Level</label>
                        <select name="level" id="level" class="form-control col-md-8">
                            @foreach (list_leveluser() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Password</label>
                        <input type="password" name="password" id="password" class="form-control col-md-8" placeholder="********" required  autocomplete="off">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Ulangi Password</label>
                        <input type="password" name="password_confirmation" id="password" class="form-control col-md-8" placeholder="********" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Photo</label>
                        <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control col-md-8" required>
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
    <div class="modal fade" id="ubah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route('adminuser.update','test')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama </label>
                        <input type="text" name="name" id="name" class="form-control col-md-8" placeholder="Nama User" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">email</label>
                        <input type="text" name="email" id="email" class="form-control col-md-8" placeholder="Alamat Email" required>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Level</label>
                        <select name="level" id="level" class="form-control col-md-8">
                            @foreach (list_leveluser() as $item)
                                <option value="{{ $item}}">{{ $item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Password</label>
                        <input type="password" name="password" id="password" class="form-control col-md-8" autocomplete="off">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Ulangi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control col-md-8">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Photo (jika ingin diubah)</label>
                        <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control col-md-8">
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
