<x-mazer-layout title="Pengaturan Akun">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data User" active="Pengatura Akun"></x-header>
            <div class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Pengaturan Akun</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <section class="container">
                                <form action="{{ route('user.update','test')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="id" value="{{ $user->id}}">
                                    <input type="hidden" name="level" value="{{ $user->level}}">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group p-2">
                                                <label for="">Nama Lengkap <strong class="text-danger">*</strong></label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" name="name" value="{{ $user->name}}" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group p-2">
                                                <label for="">Email <strong class="text-danger">*</strong></label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="email" name="email" value="{{ $user->email}}" class="form-control" required>
                                                <small class="font-italic">email digunakan untuk login ke sistem</small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 text-center">
                                            <section class="container">
                                                @if (is_null($user->photo))
                                                    <img src="{{ asset('/img/avatar.png')}}" alt="" class="img-fluid">
                                                    <small>Photo default</small>
                                                @else
                                                    <img src="{{ asset('/img/user/'.$user->photo)}}" alt="" class="img-fluid">
                                                @endif
                                            </section>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">Upload Photo untuk melakukan perubahan pada photo</label>
                                                <input type="file" class="form-control" name="photo">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="callout callout-success">
                                                <p>Abaikan Form Password jika tidak ingin dirubah</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group p-2">
                                                <label for="">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="password" name="password" placeholder="******" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group p-2">
                                                <label for="">Ulangi Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="password" name="password_confirmation" placeholder="******" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-success btn-sm float-end"><i class="fas fa-pen"></i> SIMPAN PERUBAHAN</button>
                                    </div>
                                </form>
                            </section>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-mazer-layout>