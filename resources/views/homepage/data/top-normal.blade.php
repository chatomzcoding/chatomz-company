@php
$infowebsite    = App\Models\Infowebsite::first(); 
$dkategori      = App\Models\Kategoriproduk::where('status','aktif')->orderBy('nama_kategori','ASC')->get(); 
@endphp
 <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Kategori</span>
                        </div>
                        <ul>
                            @foreach ($dkategori as $item)
                                <li><a href="{{ url('/h/kategoriproduk/'.$item->slug)}}">{{ ucwords($item->nama_kategori)}}</a></li>
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
                                <span>Info Lebih Lanjut</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->