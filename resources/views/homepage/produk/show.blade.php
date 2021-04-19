@extends('layouts.homepage')

@section('meta')
    <!-- Image to display -->
    <!-- Replace   «example.com/image01.jpg» with your own -->
    <meta property="og:image" content="{{ asset('/img/market/produk/'.$produk->poto_produk)}}">

    <!-- No need to change anything here -->
    <meta property="og:type" content="website" />
    <meta property="og:image:type" content="image/jpeg">

    <!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">

    <!-- Website to visit when clicked in fb or WhatsApp-->
    <meta property="og:url" content="https://bunefit.com/">
@endsection

@section('title')
    Market - Produk {{ $produk->nama_produk}}
@endsection

@section('container')

    @include('homepage.data.top-normal')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('/img/admin/info/'.$info->bg_produk)}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 class="text-capitalize">{{ $produk->nama_produk}}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/')}}">Beranda</a>
                            <a href="{{ url('/h/kategori')}}">{{ $kategori->nama_kategori}}</a>
                            <span  class="text-capitalize">{{ $produk->nama_produk}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset('/img/market/produk/'.$produk->poto_produk)}}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{ asset('/img/market/produk/'.$produk->poto_produk)}}"
                            src="{{ asset('/img/market/produk/'.$produk->poto_produk)}}">
                            @if (!is_null($produk->poto_1))
                                <img data-imgbigurl="{{ asset('/img/market/produk/'.$produk->poto_1)}}"
                                    src="{{ asset('/img/market/produk/'.$produk->poto_1)}}">
                            @endif
                            @if (!is_null($produk->poto_2))
                                <img data-imgbigurl="{{ asset('/img/market/produk/'.$produk->poto_2)}}"
                                    src="{{ asset('/img/market/produk/'.$produk->poto_2)}}">
                            @endif
                            @if (!is_null($produk->poto_3))
                                <img data-imgbigurl="{{ asset('/img/market/produk/'.$produk->poto_3)}}"
                                    src="{{ asset('/img/market/produk/'.$produk->poto_3)}}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3 class="text-capitalize">{{ $produk->nama_produk}}</h3>
                        <hr>
                        {{-- <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div> --}}
                        @if (DbChatomz::produkdiskonid($produk->id))
                            <div class="alert alert-success">
                                Produk ini sedang <strong>DISKON {{ $diskon->nilai_diskon}}%</strong>
                            </div>
                            <div class="product__details__price">{{ rupiah(market_hitungdiskon($produk->harga_produk,$diskon->nilai_diskon))}} <small class="text-muted"><del>{{ norupiah($produk->harga_produk)}}</del></small></div>
                        @else
                            <div class="product__details__price">{{ rupiah($produk->harga_produk)}}</div>
                        @endif
                        <p class="text-justify">{{ ucfirst($produk->keterangan_produk)}}</p>
                        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-success btn-sm"><i class="fa fa-shopping-bag"></i> PESAN SEKARANG</a><hr>
                        <section class="row footer__widget">
                            <div class="col-md-4">
                                Bagikan ke : 
                            </div>
                            <div class="footer__widget__social p-3">
                                <a href="{{ market_bagikankewhatsapp($produk->slug)}}"><i class="fab fa-whatsapp-square"></i></a>
                                {{-- <a href="{{ $infowebsite->link_fb}}" target="_blank"><i class="fab fa-facebook-square"></i></i></a> --}}
                                {{-- <a href="{{ $infowebsite->link_ig}}" target="_blank"><i class="fab fa-instagram-square"></i></a> --}}
                                {{-- <a href="{{ $infowebsite->link_tw}}" target="_blank"><i class="fab fa-twitter-square"></i></a> --}}
                            </div>
                        </section>
                        <ul>
                            <li><b>Stok</b> <span>: {{ $produk->stok}}</span></li>
                        </ul>
                        <hr>
                        <section class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('/img/market/toko/'.$toko->logo_toko)}}" alt="" class="img-rounded">
                            </div>
                            <div class="col-md-8">
                                <p> <strong>Toko {{ $toko->nama_toko}} </strong> <br>
                                    {{ $toko->alamat_toko}} <br>
                                    <a href="{{ url('/h/toko/'.$toko->slug)}}">Kunjungi Toko</a>
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
                {{-- <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque amet laborum nulla voluptatibus, ipsam ratione, iusto optio neque, error dolore velit quis eos doloribus fugit hic debitis excepturi. Laudantium, rerum.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, debitis fuga? Id doloribus sed nobis natus, voluptatem distinctio aliquam ducimus, inventore praesentium sequi labore non reiciendis quibusdam repellat nemo fuga?</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum dolorum pariatur sapiente natus molestiae animi incidunt quidem vel, ex consequuntur illum impedit eligendi earum nesciunt corporis facilis itaque harum sed?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Produk dengan kategori sama</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($produksama as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="featured__item border">
                            <a href="{{ url('/h/produk/'.$item->slug)}}">
                                <div class="product__discount__item__pic set-bg">
                                    <img src="{{ asset('/img/market/produk/'.$item->poto_produk)}}" alt="">
                                    @php
                                        $diskon = DbChatomz::produkdiskonid($item->id);
                                    @endphp
                                    @if ($diskon)
                                        <div class="product__discount__percent">{{ $diskon->nilai_diskon}}%</div>
                                    @endif
                                    {{-- <ul class="product__item__pic__hover"> --}}
                                        {{-- <li><a href="#"><i class="fa fa-heart"></i></a></li> --}}
                                        {{-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> --}}
                                        {{-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> --}}
                                    {{-- </ul> --}}
                                </div>
                                <div class="product__item__text">
                                    <h6 class="text-capitalize">{{ $item->nama_produk}}</h6>
                                    @if ($diskon)
                                        <h5><span class="text-danger">{{ rupiah(market_hitungdiskon($item->harga_produk,$diskon->nilai_diskon))}}</span> <small><del>{{ norupiah($item->harga_produk)}}</del></small></h5>
                                    @else
                                        <h5>{{ rupiah($item->harga_produk)}}</h5>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col text-center">
                        <span>belum ada produk</span>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <!-- Large modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button> --}}

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="post" action="{{ url('/h/kirimpesanan')}}">
            @csrf
            <input type="hidden" name="produk_id" value="{{ $produk->id}}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulir pemesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="p-2">
                    <div class="alert alert-warning">
                        Tanda <span class="text-danger">*</span> Wajib diisi
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 p-2">Nama Lengkap<span class="text-danger">*</span></label>
                        <input type="text" name="nama_pemesan" class="form-control col-md-8" id="recipient-name" placeholder="masukkan nama lengkap" required>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 p-2">Jumlah Pemesanan<span class="text-danger">*</span></label>
                        <input type="number" name="jumlah" class="form-control col-md-8" min="1"  max="{{ $produk->stok}}" value="1" required>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 p-2">No Telp<span class="text-danger">*</span></label>
                        <input type="text" name="telp" class="form-control col-md-8" maxlength="20" id="recipient-name" placeholder="08xxxxxxx" required>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 p-2">Alamat Pengiriman<span class="text-danger">*</span></label>
                        <textarea name="alamat_pengiriman" id="" cols="30" rows="3" class="form-control col-md-8" placeholder="masukkan alamat pengiriman atau alamat anda" required></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 p-2">Kota<span class="text-danger">*</span></label>
                        <input type="text" name="kota" class="form-control col-md-8" id="recipient-name" placeholder="masukkan kota anda" required>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-md-4 p-2">Cacatan Pengiriman (opsional)</label>
                        <textarea name="catatan" id="" cols="30" rows="3" class="form-control col-md-8" placeholder="kirim catatan ke seller / penjual"></textarea>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection