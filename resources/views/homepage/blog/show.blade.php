@extends('layouts.homepage')

@section('title')
    Blog Detail
@endsection

@section('container')
    @php
    $infowebsite = App\Models\Infowebsite::first(); 
    @endphp
   
   @include('homepage.data.top-normal')

    <!-- Blog Details Hero Begin -->
    <section class="blog-details-hero set-bg" data-setbg="{{ asset('/img/admin/info/'.$infowebsite->bg_produk)}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>{{ $blog->judul_artikel}}</h2>
                        <ul>
                            <li>{{ $user->name}}</li>
                            <li>{{ tgl_artikel($blog->created_at)}}</li>
                            {{-- <li>8 Comments</li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    <div class="blog__sidebar">
                        {{-- <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div> --}}
                        <div class="blog__sidebar__item">
                            <h4>Kategori Blog</h4>
                            <ul>
                                <li><a href="{{ url('/h/blog')}}">Semua</a></li>
                                @foreach ($kategori as $item)
                                    <li class="text-capitalize"><a href="{{ url('/h/blog/kategori/'.$item->slug)}}">{{ $item->nama_kategori}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Blog Terbaru</h4>
                            <div class="blog__sidebar__recent">
                                @foreach ($blogrecent as $item)
                                    <a href="{{ url('/h/blog/'.$item->slug)}}" class="blog__sidebar__recent__item">
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
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <img src="{{ asset('/img/admin/artikel/'.$blog->gambar_artikel)}}" alt="" width="100%">
                        <section class="text-justify">
                            {!! $blog->isi_artikel !!}
                        </section>
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{ asset('/img/user/'.$user->profile_photo_path)}}" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>{{ $user->name}}</h6>
                                        <span class="text-capitalize">{{ $user->level}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Kategori :</span> {{ DbChatomz::showtablefirst('kategori_artikel',['id',$blog->kategoriartikel_id])->nama_kategori}}</li>
                                        <li><span>Diterbitkan : </span>{{ tgl_artikel($blog->created_at)}}</li>
                                        {{-- <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li> --}}
                                    </ul>
                                    {{-- <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>Artikel Lainnya</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($blogrecent as $item)
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
                                <h5><a href="#">{{ $item->judul_artikel}}</a></h5>
                                <section>
                                    {!! substr($item->isi_artikel,0,100)!!}...
                                </section>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        belum ada artikel
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Related Blog Section End -->
@endsection