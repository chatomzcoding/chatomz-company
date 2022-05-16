@if ($url == '#')
    <a href="#" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#{{ $id }}"><i class="bi bi-pencil"></i></a>
@else
    <a href="{{ url($url) }}" class="btn btn-outline-success btn-sm"><i class="bi bi-pencil"></i></a>
@endif