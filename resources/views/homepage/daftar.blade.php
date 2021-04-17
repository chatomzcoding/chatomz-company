@extends('layouts.homepage')

@section('title')
    Bunefit - Daftar Akun
@endsection

@section('container')

@php
$infowebsite = App\Models\Infowebsite::first(); 
@endphp
@include('homepage.data.top-normal')


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('/img/admin/info/'.$infowebsite->bg_produk)}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Daftar Akun</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/')}}">Beranda</a>
                            <span>Daftar Akun Baru</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <form action="{{ url('/simpandaftar')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 p-3">
                        <section class="text-center">
                            <h5>FORMULIR PENDAFTARAN AKUN BARU</h5>
                            <p>Bergabunglah bersama Bunefit.com, bersama membangun usaha dan mengembangkan perekonomian</p>
                        </section>
                        <div class="alert alert-warning text-left">
                            Tanda <strong class="text-danger">*</strong> Wajib Diisi <br>
                            Gambar format Jpg, Png, Jpeg ukuran maksimal 1 Mb <br>
                            password minimal 6 huruf
                        </div>
                    @include('sistem.notifikasi')
                    @if ($errors->any())
                    <section>
                        <div class="alert alert-danger p-2">
                            <section class="p-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </section>
                        </div>
                    </section>
                    @endif
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-user"></i> Identitas Pemilik
                            </div>
                            <div class="card-body">
                                <section class="p-3">
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">Nama<strong class="text-danger">*</strong> </label>
                                        <input type="text" name="name" id="name" class="form-control col-md-8" value="{{ old('name')}}" placeholder="Nama User" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">email<strong class="text-danger">*</strong></label>
                                        <input type="text" name="email" id="email" class="form-control col-md-8"  value="{{ old('email')}}" placeholder="Alamat Email" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">Password<strong class="text-danger">*</strong></label>
                                        <input type="password" name="password" id="password" class="form-control col-md-8" placeholder="********" required  autocomplete="off">
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">Ulangi Password<strong class="text-danger">*</strong></label>
                                        <input type="password" name="password_confirmation" id="password" class="form-control col-md-8" placeholder="********" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">Photo<strong class="text-danger">*</strong></label>
                                        <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control col-md-8" required>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-store"></i> Identitas Toko
                            </div>
                            <div class="card-body">
                                <section class="p-3">
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">Nama Toko<strong class="text-danger">*</strong></label>
                                        <input type="text" name="nama_toko" id="nama_toko" class="form-control col-md-8" value="{{ old('nama_toko')}}" placeholder="Nama Toko" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">Alamat Toko<strong class="text-danger">*</strong></label>
                                        <input type="text" name="alamat_toko" id="alamat_toko" class="form-control col-md-8" placeholder="Alamat" value="{{ old('alamat_toko')}}" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">No Hp Toko<strong class="text-danger">*</strong></label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control col-md-8" placeholder="08xxxx" value="{{ old('no_hp')}}" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">Tentang Toko<strong class="text-danger">*</strong></label>
                                        <input type="text" name="keterangan_toko" id="keterangan_toko" class="form-control col-md-8" placeholder="Tentang Toko" value="{{ old('keterangan_toko')}}" required>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-4 p-2">Logo<strong class="text-danger">*</strong></label>
                                        <input type="file" name="logo_toko" id="profile_photo_path" class="form-control col-md-8" required>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 p-2">
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> BUAT AKUN</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection