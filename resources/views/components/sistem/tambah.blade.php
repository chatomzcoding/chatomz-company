@if ($url == '#')
    <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#{{ $id }}"><i class="bi bi-plus-circle-fill"></i> {{ $slot ?? '' }}</a>
@else
    <a href="{{ url($url) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus-circle-fill"></i>{{ $slot ?? '' }}</a>
@endif