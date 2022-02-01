@section('title')
    DASHBOARD
@endsection
<x-app-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Halaman 404</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
                <li class="breadcrumb-item active">404 - Halaman tidak ditemukan</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
    </x-slot>
    <section class="content">
        <div class="error-page">
          <h2 class="headline text-warning"> 404</h2>
  
          <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
  
            <p>
              We could not find the page you were looking for.
              Meanwhile, you may <a href="../../index.html">return to dashboard</a> or try using the search form.
            </p>
  
            <form class="search-form">
              <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search">
  
                <div class="input-group-append">
                  <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
              <!-- /.input-group -->
            </form>
          </div>
          <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
      </section>
</x-app-layout>