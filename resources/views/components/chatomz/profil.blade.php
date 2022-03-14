@if ($profil)
    <div class="d-flex align-items-center">
        <div class="avatar avatar-xl">
            <img src="{{ asset('img/chatomz/orang/'.$profil->photo)}}" alt="Photo">
        </div>
        <div class="ms-3 name">
            <h5 class="font-bold small">{{ fullname($profil) }}</h5>
            <h6 class="text-muted mb-0">{{ $profil->gender }}</h6>
        </div>
    </div>
@endif