<form id="data-{{ $id }}" action="{{url($link,$id)}}" method="post">
    @csrf
    @method('delete')
</form>
<div class="dropdown dropend">
    <button class="btn btn-primary btn-sm dropdown-toggle me-1  dropright" type="button"
        id="dropdownMenuButton" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Aksi
    </button>
    <div class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton">
        {{ $slot }}
    <button onclick="deleteRow( {{ $id }} )" class="dropdown-item text-danger"><i class="bi-trash w20p"></i> HAPUS</button>
    </div>
</div>