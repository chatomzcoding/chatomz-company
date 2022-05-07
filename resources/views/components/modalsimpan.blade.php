<form action="{{ url($link ?? '') }}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="modal fade text-left modal-borderless" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog {{ $size }} modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h5 class="modal-title">{{ $judul ?? 'Tambah Data' }}</h5>
                <button type="button" class="btn btn-outline-light btn-sm" data-bs-dismiss="modal" aria-label="Close"><i data-feather="x" class="bi-x-square text-secondary"></i>
                </button>
            </div>
            <div class="modal-body py-0">
                <section>
                   {{ $slot }}
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary btn-sm"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none bi-x-square"></i>
                    <span class="d-none d-sm-block"><i class="bi-x-square"></i> TUTUP</span>
                </button>
                <button type="submit" class="btn btn-primary btn-sm ml-1">
                    <i class="bx bx-check d-block d-sm-none bi bi-save"></i>
                    <span class="d-none d-sm-block"><i class="bi bi-save"></i> SIMPAN</span>
                </button>
            </div>
        </div>
    </div>
</div>
</form>