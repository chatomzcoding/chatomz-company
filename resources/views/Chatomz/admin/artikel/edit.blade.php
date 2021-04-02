@section('title')
    SIDESA - edit artikel {{ $artikel->judul_artikel}}
@endsection
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> --}}
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Data Artikel - Edit Artikel</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ url('artikel')}}">Daftar Artikel</a></li>
                <li class="breadcrumb-item active">Edit Artikel</li>
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
                {{-- <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Artikel </a> --}}
                <a href="{{ url('/artikel')}}" class="btn btn-outline-primary btn-flat btn-sm"><i class="fas fa-plus"></i> Kembali ke daftar artikel </a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <section>
                        <form action="{{ url('/artikel/'.$artikel->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label for="" class="col-md-4 p-2">Judul Artikel</label>
                                <input type="text" name="judul_artikel" id="judul_artikel" class="form-control col-md-8" value="{{ $artikel->judul_artikel}}" required>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-4 p-2">Kategori Artikel</label>
                                <select name="kategoriartikel_id" id="" class="form-control col-md-8">
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id}}" @if ($item->id == $artikel->kategoriartikel_id)
                                            selected
                                        @endif>{{ $item->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-4 p-2">Gambar Artikel (ubah gambar)</label>
                                <input type="file" name="gambar_artikel" id="judul_artikel" class="form-control col-md-8">
                            </div>
                            <div class="form-group">
                                <label for="">isi artikel</label>
                                <textarea name="isi_artikel" id="isi_artikel" cols="30" rows="10">{{ $artikel->isi_artikel}}</textarea>
                            </div>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                // instance, using default configuration.
                                CKEDITOR.replace('isi_artikel', {
                                width: '100%',
                                height: 400
                                });
                            </script>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm">SIMPAN PERUBAHAN</button>
                            </div>
                        </form>
                  </section>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-app-layout>
