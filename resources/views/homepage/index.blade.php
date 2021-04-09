@extends('layouts.homepage')

@section('title')
    Selamat Datang
@endsection

@section('container')
    
    @include('homepage.data.top-utama')

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="slider">
                        <div class="slides">
                            @foreach ($kategoriproduk as $item)
                                <div style="height: 190px;">
                                    <a href="{{ url('/h/kategoriproduk/'.$item->slug)}}">
                                        <img src="{{ asset('/img/market/kategoriproduk/'.$item->icon)}}" width="110px" alt=""><br>
                                        <small class="text-capitalize">{{ $item->nama_kategori}}</small>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Produk Terbaru berdasarkan kategori</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">Semua</li>
                            @foreach ($kategoriproduk as $item)
                                <li data-filter=".kategori{{$item->id}}" class="text-capitalize">{{ $item->nama_kategori}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($produk as $item)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mix kategori{{ $item->kategoriproduk_id}}">
                        <div class="featured__item">
                            <div class="product__discount__item__pic set-bg"
                            data-setbg="{{ asset('/img/market/produk/'.$item->poto_produk)}}">
                                @php
                                    $diskon = DbChatomz::showtablefirst('produk_diskon',['produk_id',$item->id]);
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
                            <div class="featured__item__text">
                                <h6><a href="{{ url('/h/produk/'.$item->slug)}}">{{ $item->nama_produk}}</a></h6>
                                @if ($diskon)
                                    <h5><span class="text-danger">{{ rupiah(market_hitungdiskon($item->harga_produk,$diskon->nilai_diskon))}}</span> <small><del>{{ norupiah($item->harga_produk)}}</del></small></h5>
                                @else
                                    <h5>{{ rupiah($item->harga_produk)}}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                @forelse ($iklanbawah as $item)
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="{{ asset('/img/admin/iklan/'.$item->gambar_iklan)}}" alt="{{ $item->nama_iklan}}">
                        </div>
                    </div>
                @empty
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="{{ asset('/template/ogani/img/banner/banner-1.jpg')}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="{{ asset('/template/ogani/img/banner/banner-2.jpg')}}" alt="">
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Produk Terbaru</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($slideproduk['baru'] as $item)
                                <div class="latest-prdouct__slider__item">
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic" style="width: 100px;">
                                            <img src="{{ asset('/img/market/produk/'.$item->poto_produk)}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $item->nama_produk}}</h6>
                                            <span>{{ rupiah($item->harga_produk)}}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Produk Sering Dilihat</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($slideproduk['view'] as $item)
                                <div class="latest-prdouct__slider__item">
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic" style="width: 100px;">
                                            <img src="{{ asset('/img/market/produk/'.$item->poto_produk)}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $item->nama_produk}}</h6>
                                            <span>{{ rupiah($item->harga_produk)}}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Produk Review Terbanyak</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__text">
                                        <h6>Maintenance</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($artikel as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset('/img/admin/artikel/'.$item->gambar_artikel)}}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{ tgl_artikel($item->created_at)}}</li>
                                    {{-- <li><i class="fa fa-comment-o"></i> 5</li> --}}
                                </ul>
                                <h5><a href="{{ url('/h/blog/'.$item->slug)}}">{{ $item->judul_artikel}}</a></h5>
                                <section>
                                    {!! Str::substr($item->isi_artikel, 0, 100) !!}...
                                </section>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    @endsection