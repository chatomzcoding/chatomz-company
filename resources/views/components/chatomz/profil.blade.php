@if ($profil)
    <a href="{{ url('orang/'.Crypt::encryptString($profil->id)) }}">
        <div class="d-flex align-items-center">
            <div class="avatar avatar-xl">
                <img src="{{ asset('img/chatomz/orang/'.$profil->photo)}}" alt="Photo">
            </div>
            <div class="ms-3 name">
                <h5 class="font-bold small">{{ fullname($profil) }}</h5>
                <h6 class="text-muted mb-0 small">{{ kingdom_umur($profil->date_birth) }} Tahun</h6>
            </div>
        </div>
    </a>
@endif