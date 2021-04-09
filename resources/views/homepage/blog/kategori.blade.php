@extends('layouts.homepage')

@section('title')
    Blog
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
                        <h2>Blog</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/')}}">Beranda</a>
                            <span>Kategori</span>
                            <span>{{ $kategorifirst->nama_kategori}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        {{-- <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div> --}}
                        <div class="blog__sidebar__item">
                            <h4>Kategori Blog Lainnya</h4>
                            <ul>
                                <li><a href="{{ url('/h/blog')}}">Semua</a></li>
                                @foreach ($kategori as $item)
                                    @if ($item->id <> $kategorifirst->id)
                                    <li class="text-capitalize"><a href="{{ url('/h/blog/kategori/'.$item->slug)}}">{{ $item->nama_kategori}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Artikel Terbaru</h4>
                            <div class="blog__sidebar__recent">
                                @foreach ($blogrecent as $item)
                                    <a href="#" class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="{{ asset('/img/admin/artikel/'.$item->gambar_artikel)}}" alt="" width="100px">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6 class="text-capitalize">{{ $item->judul_artikel}}</h6>
                                            <span>{{ tgl_artikel($item->created_at)}}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="blog__sidebar__item">
                            <h4>Search By</h4>
                            <div class="blog__sidebar__item__tags">
                                <a href="#">Apple</a>
                                <a href="#">Beauty</a>
                                <a href="#">Vegetables</a>
                                <a href="#">Fruit</a>
                                <a href="#">Healthy Food</a>
                                <a href="#">Lifestyle</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        @forelse ($blog as $item)
                            <div class="col-lg-6 col-md-6 col-sm-6">
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
                                            {!! substr($item->isi_artikel,0,100)!!}
                                        </section>
                                        <a href="{{ url('/h/blog/'.$item->slug)}}" class="blog__btn">Selengkapnya <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                            
                        @empty
                        <div class="col-md-12 text-center">
                            <span class="text-secondary">belum ada artikel kategori {{ $kategorifirst->nama_kategori}}</span>
                        </div>
                        @endforelse
                    </div>
                    @if (count($blog) > 0)
                        <div class="row">
                            <div class="col-md-12">
                                {{ $blog->links('homepage.data.page') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection