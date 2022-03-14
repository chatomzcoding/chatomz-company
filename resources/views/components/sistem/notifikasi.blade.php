<div>
    {{-- notif custom --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {!! session('info') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!! session('danger') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {!! session('warning') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('secondary'))
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
            {!! session('secondary') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- end notif custom --}}


    {{-- notifikasi CRUD template--}}
    @if (session('ds'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <h5>Berhasil!</h5>
            <p>Data {{ session('ds') }} telah ditambahkan</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('du'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Berhasil!</h5>
            <p>Data {{ session('du') }} telah ditambahkan</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('dd'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>Berhasil!</h5>
            <p>Data {{ session('dd') }} telah ditambahkan</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- end notifikasi CRUD template --}}

    {{-- notifikasi error form input --}}
    @if (isset($errors))
        <ul>
        @foreach ($errors->all() as $item)
            <li>{{ $item }}</li>
        @endforeach
        </ul>
    @endif
    {{-- end notifikasi error form input --}}
</div>