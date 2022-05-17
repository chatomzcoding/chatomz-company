<div class="page-title">
    <section class="d-block d-sm-none">
        <form action="{{ url('pencarian') }}" method="get">
            @csrf
            <input type="hidden" name="s" value="carinama">
            <div class="input-group mb-3">
                <input type="text" name="nama" class="form-control" placeholder="cari disini ..." aria-label="cari disini ..." aria-describedby="button-addon2" autocomplete="off" required>
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="bi-search"></i></button>
            </div>
        </form>
    </section>
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $head }}</h3>
            <p class="text-subtitle text-muted">{{ $p }}</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard')}}"><i class="bi-house-fill"></i></a></li>
                    @if (!is_null($hyperlink))
                        @foreach ($hyperlink as $name => $link)
                            <li class="breadcrumb-item text-capitalize"><a href="{{ url($link)}}">{{ $name }}</a></li>
                        @endforeach
                    @endif
                    {{ $slot }}
                    <li class="breadcrumb-item active" aria-current="page">{{ $active }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <x-sistem.notifikasi/>
</div>