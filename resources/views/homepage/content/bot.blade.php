@extends('layouts.homepage')
@section('title')
    Chatomz Bot
@endsection
@section('content')
    
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
  
          <ol>
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li>Bot</li>
          </ol>
          <h2>Chatomz Bot</h2>
        </div>
      </section><!-- End Breadcrumbs -->
  
      <!-- ======= Blog Section ======= -->
      <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
  
          <div class="row">
  
            <div class="col-lg-8 entries">
  
              <article class="entry">
  
                <div class="entry-img">
                  <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                </div>
  
                <h2 class="entry-title text-center">
                    SELAMAT DATANG DI CHATOMZ BOT <br>
                    <i class="bi bi-robot h1 text-info"></i>
                </h2>
  
                <div class="entry-meta">
                  <ul class="small">
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>Firman Setiawan</li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i><time datetime="2020-01-01">Februari 2022</time></li>
                    <li class="d-flex align-items-center"><i class="bi bi-code-square"></i>Versi 1.1</li>
                  </ul>
                </div>
  
                <div class="entry-content">
                    <form action="" method="get">
                        <div class="form-group">
                            <input type="text" name="pertanyaan" class="form-control" placeholder="ketik pertanyaan disini!" autocomplete="off" autofocus required>
                        </div>
                        @if (!is_null($jawaban))
                            <div class="alert alert-info my-2 p-2">
                                {!! $jawaban !!}
                            </div>
                        @endif
                        <div class="form-group mt-3 text-center">
                            <button type="submit" class="btn btn-outline-info">KIRIM PERTANYAAN</button>
                        </div>
                    </form>
                    <div class="callout callout-warning">
                        <hr>
                        <strong>Catatan !</strong> <br>
                        <small>bot ini masih belajar kosa kata dan pertanyaan, bot akan belajar dari pertanyan yang belum dia kuasai <br> terima kasih orang baik :) </small>
                    </div>
                  <div class="read-more">
                    <a href="#">Pelajari tentang chatomz bot lebih lanjut <i class="bi bi-arrow-right-square"></i></a>
                  </div>
                </div>
  
              </article><!-- End blog entry -->
  
            </div><!-- End blog entries list -->
  
            <div class="col-lg-4">
  
              <div class="sidebar">
  
                <h3 class="sidebar-title">Search</h3>
                <div class="sidebar-item search-form">
                  <form action="">
                    <input type="text">
                    <button type="submit"><i class="bi bi-search"></i></button>
                  </form>
                </div><!-- End sidebar search formn-->
  
                <h3 class="sidebar-title">Categories</h3>
                <div class="sidebar-item categories">
                  <ul>
                    <li><a href="#">General <span>(25)</span></a></li>
                    <li><a href="#">Lifestyle <span>(12)</span></a></li>
                    <li><a href="#">Travel <span>(5)</span></a></li>
                    <li><a href="#">Design <span>(22)</span></a></li>
                    <li><a href="#">Creative <span>(8)</span></a></li>
                    <li><a href="#">Educaion <span>(14)</span></a></li>
                  </ul>
                </div><!-- End sidebar categories-->
  
              </div><!-- End sidebar -->
  
            </div><!-- End blog sidebar -->
  
          </div>
  
        </div>
      </section><!-- End Blog Section -->
@endsection
