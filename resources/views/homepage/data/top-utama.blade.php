@php
    $infowebsite = App\Models\Infowebsite::first(); 
@endphp
  <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Kategori</span>
                        </div>
                        <ul>
                            @foreach (DbChatomz::showtable('kategori_produk',['status','aktif']) as $item)
                                <li><a href="{{ url('/h/kategoriproduk/'.$item->slug)}}">{{ $item->nama_kategori}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#" method="post">
                                @csrf
                                <div class="hero__search__categories">
                                    Semua Kategori
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="apa yang anda butuhkan?">
                                <button type="submit" class="site-btn">Cari Disini</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>{{ $infowebsite->telp}}</h5>
                                <span>support 24/7 waktu</span>
                            </div>
                        </div>
                    </div>
                    @if ($iklan)
                        <div class="hero__item set-bg" data-setbg="{{ asset('/img/admin/iklan/'.$iklan->gambar_iklan)}}">
                            <div class="hero__text">
                                <span>{{ $iklan->teks_penting}}</span>
                                <h2>{{ $iklan->nama_iklan}}</h2>
                                <p>{{ $iklan->teks_kecil}}</p>
                                <a href="{{ $iklan->link}}" class="primary-btn" target="_blank">{{ $iklan->nama_link}}</a>
                            </div>
                        </div>
                    @else
                        <div class="hero__item set-bg" data-setbg="{{ asset('/template/ogani/img/hero/banner.jpg')}}">
                            <div class="hero__text">
                                <span>teks penting penanda (label)</span>
                                <h2>nama iklan sebagai inti informasi</h2>
                                <p>area informasi kecil</p>
                                <a href="#" class="primary-btn">nama link</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->