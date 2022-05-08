<form action="{{ route($link.'.update','id') }}" method="POST" enctype="multipart/form-data">
   @csrf
   @method('patch')
<div class="modal fade text-left modal-borderless" id="{{ $id }}" tabindex="{{ $tabindex }}" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog {{ $size }} modal-dialog-scrollable" role="document">
        <div class="modal-content">
               <div class="modal-header p-2 text-capitalize">
                <h5 class="modal-title"><i class="bi bi-pen"></i> {{ $judul }}</h5>
                <button type="button" class="btn btn-outline-light btn-sm" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x" class="bi-x-square text-secondary"></i>
                </button>
            </div>
            <div class="modal-body py-0">
                @if ($id == 'ubah')
                <input type="hidden" name="id" id="id">
                @endif
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary btn-sm"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none bi-x-square"></i>
                    <span class="d-none d-sm-block"><i class="bi-x-square"></i> TUTUP</span>
                </button>
                <button type="submit" class="btn btn-success btn-sm ml-1">
                    <i class="bx bx-check d-block d-sm-none bi bi-save"></i>
                    <span class="d-none d-sm-block"><i class="bi bi-save"></i> SIMPAN PERUBAHAN</span>
                </button>
            </div>
        </div>
    </div>
</div>
</form>