<x-mazer-layout>
    <x-slot name="title">
        Admin - Data Info Website
    </x-slot>
    <x-slot name="content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Info Website</h3>
                        <p class="text-subtitle text-muted">Pengaturan informasi website</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Info Website</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                          <x-sistem.notifikasi/>
                          <section>
                            <form action="{{ url('/info-website/'.$info->id)}}" method="post" enctype="multipart/form-data">
                               @csrf
                               @method('patch')
                               <input type="hidden" name="id" value="{{ $info->id}}">
                               <div class="row">
                                   <div class="col-md-6 p-4">
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Tagline</label>
                                           <input type="text" name="teks_atas" value="{{ $info->teks_atas}}" class="form-control col-md-8" required>
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Alamat Email</label>
                                           <input type="email" name="email" value="{{ $info->email}}" class="form-control col-md-8" required>
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">No Telp</label>
                                           <input type="text" name="telp" value="{{ $info->telp}}" class="form-control col-md-8" required>
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Alamat</label>
                                           <input type="text" name="alamat" value="{{ $info->alamat}}" class="form-control col-md-8" required>
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Tentang Website</label>
                                           <textarea name="tentang" id="" class="form-control col-md-8" cols="30" rows="4">{{ $info->tentang}}</textarea>
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Alamat di Google Maps</label>
                                           <textarea name="maps" id="" class="form-control col-md-8" cols="30" rows="4">{{ $info->maps}}</textarea>
                                       </div>
                                   </div>
                                   <div class="col-md-6 p-4">
                                       <div class="form-group row">
                                           <div class="col-md-4 p-2">
                                               <img src="{{ asset('/img/admin/info/'.$info->logo_brand)}}" alt="" class="img-fluid">
                                           </div>
                                           <div class="col-md-8">
                                               <label for="" >Logo Icon</label>
                                               <input type="file" name="logo_brand" class="form-control">
                                               <i>unggah jika ingin merubah</i>
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <div class="col-md-4 p-2">
                                               <img src="{{ asset('/img/admin/info/'.$info->bg_produk)}}" alt="" class="img-fluid">
                                           </div>
                                           <div class="col-md-8">
                                               <label for="" >Logo Full</label>
                                               <input type="file" name="bg_produk" class="form-control">
                                               <i>unggah jika ingin merubah</i>
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Link Facebook</label>
                                           <input type="url" name="link_fb" value="{{ $info->link_fb}}" class="form-control col-md-8">
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Link Twitter</label>
                                           <input type="url" name="link_tw" value="{{ $info->link_tw}}" class="form-control col-md-8">
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Link Youtube</label>
                                           <input type="url" name="link_yt" value="{{ $info->link_yt}}" class="form-control col-md-8">
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Link Instagram</label>
                                           <input type="url" name="link_ig" value="{{ $info->link_ig}}" class="form-control col-md-8">
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Link Pinterest</label>
                                           <input type="url" name="link_pi" value="{{ $info->link_pi}}" class="form-control col-md-8">
                                       </div>
                                       <div class="form-group row">
                                           <label for="" class="col-md-4 p-2">Link Linkedin</label>
                                           <input type="url" name="link_in" value="{{ $info->link_in}}" class="form-control col-md-8">
                                       </div>
                                       <div class="form-group">
                                           <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-pen"></i> SIMPAN PERUBAHA</button>
                                       </div>
                                   </div>
                               </div>
                            </form>
                        </section>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
        </div>
    </x-slot>
</x-mazer-layout>
