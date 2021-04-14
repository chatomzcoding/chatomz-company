@extends('layouts.homepage')

@section('meta')
    <!-- Image to display -->
    <!-- Replace   «example.com/image01.jpg» with your own -->
    <meta property="og:image" content="{{ asset('/img/market/toko/'.$toko->logo_toko)}}">

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
    Bunefit.com - Toko {{ $toko->nama_toko}}
@endsection

@section('container')

    @include('homepage.data.top-normal')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('/img/admin/info/'.$info->bg_produk)}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 class="text-capitalize">{{ $toko->nama_toko}}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/')}}">Beranda</a>
                            <span>Toko</span>
                            <span  class="text-capitalize">{{ $toko->nama_toko}}</span>
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
                <div class="col-lg-4 col-md-4">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset('/img/market/toko/'.$toko->logo_toko)}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="product__details__text">
                        <h3 class="text-capitalize">{{ $toko->nama_toko}}</h3>
                        <ul>
                            <li><b>Total Produk</b> <span>: {{ DbChatomz::countData('produk',['toko_id',$toko->id])}}</span></li>
                            <li><b>Keterangan</b> <span>: {{ $toko->keterangan_toko}}</span></li>
                            <li><b>Alamat Toko</b> <span>: {{ $toko->alamat_toko}}</span></li>
                            <section class="row footer__widget">
                                <div class="col-md-4">
                                    Bagikan Halaman Toko : 
                                </div>
                                <div class="footer__widget__social p-3">
                                    <a href="{{ market_bagikantoko($toko->slug)}}"><i class="fab fa-whatsapp-square"></i></a>
                                    {{-- <a href="{{ $infowebsite->link_fb}}" target="_blank"><i class="fab fa-facebook-square"></i></i></a> --}}
                                    {{-- <a href="{{ $infowebsite->link_ig}}" target="_blank"><i class="fab fa-instagram-square"></i></a> --}}
                                    {{-- <a href="{{ $infowebsite->link_tw}}" target="_blank"><i class="fab fa-twitter-square"></i></a> --}}
                                </div>
                            </section>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Produk</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li> --}}
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Produk yang telah diupload</h6>
                                    <div class="row">
                                        @forelse ($produk as $item)
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <div class="featured__item border">
                                                    <div class="product__discount__item__pi set-bgc">
                                                        <img src="{{ asset('/img/market/produk/'.$item->poto_produk)}}" alt="">
                                                        @php
                                                            $diskon = DbChatomz::produkdiskonid($item->id);
                                                        @endphp
                                                        @if ($diskon)
                                                            <div class="product__discount__percent">{{ $diskon->nilai_diskon}}%</div>
                                                        @endif
                                                        <ul class="product__item__pic__hover">
                                                            {{-- <li><a href="#"><i class="fa fa-heart"></i></a></li> --}}
                                                            {{-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> --}}
                                                            {{-- <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li> --}}
                                                        </ul>
                                                    </div>
                                                    <div class="product__item__text">
                                                        <h6><a href="{{ url('/h/produk/'.$item->slug)}}" class="text-capitalize">{{ $item->nama_produk}}</a></h6>
                                                        @if ($diskon)
                                                            <h5><span class="text-danger">{{ rupiah(market_hitungdiskon($item->harga_produk,$diskon->nilai_diskon))}}</span> <small><del>{{ norupiah($item->harga_produk)}}</del></small></h5>
                                                        @else
                                                            <h5>{{ rupiah($item->harga_produk)}}</h5>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col text-center">
                                                <span>belum ada produk</span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, debitis fuga? Id doloribus sed nobis natus, voluptatem distinctio aliquam ducimus, inventore praesentium sequi labore non reiciendis quibusdam repellat nemo fuga?</p>
                                </div>
                            </div> --}}
                            {{-- <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum dolorum pariatur sapiente natus molestiae animi incidunt quidem vel, ex consequuntur illum impedit eligendi earum nesciunt corporis facilis itaque harum sed?</p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
@endsection