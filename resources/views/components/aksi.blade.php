<form id="data-{{ $id }}" action="{{url($link,$id)}}" method="post">
    @csrf
    @method('delete')
</form>
<div class="dropdown">
    <button class="btn btn-primary btn-sm dropdown-toggle me-1" type="button"
        id="dropdownMenuButton" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Aksi
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        {{ $slot }}
    <div class="dropdown-divider"></div>
    <button onclick="deleteRow( {{ $id }} )" class="dropdown-item text-danger"><i class="fas fa-trash-alt w20p"></i> HAPUS</button>
    </div>
</div>