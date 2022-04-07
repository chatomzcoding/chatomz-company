<x-mazer-layout title="Chatomz-Bot">
  <x-slot name="content">
    <div class="page-heading">
      <x-header judul="Data Chatomz Bot" active="Pengujian Bot"></x-header>
      <div class="section">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card">
                <div class="card-header">
                  {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                  <a href="{{ url('chatomzbot') }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="fas fa-angle-double-left"></i> kembali </a>
                </div>
                <div class="card-body">
                      <div class="container">
                          <header class="text-center">
                              <h3>SELAMAT DATANG DI CHATOMZ BOT</h3>
                              <p>versi 1.1</p>
                          </header>
                        
                          <form action="" method="get">
                              <input type="hidden" name="cek">
                              <div class="form-group">
                                  <input type="text" name="pertanyaan" class="form-control" placeholder="ketik pertanyaan disini!" autocomplete="off" autofocus required>
                              </div>
                              @if (!is_null($jawaban))
                                  <div class="alert alert-info">
                                      {!! $jawaban !!}
                                  </div>
                              @endif
                              <div class="form-group mt-3 text-center">
                                  <button type="submit" class="btn btn-outline-primary">KIRIM PERTANYAAN</button>
                              </div>
                          </form>
                          <div class="callout callout-warning">
                              <strong>Catatan !</strong> <br>
                              <small>bot ini masih belajar kosa kata dan pertanyaan, bot akan belajar dari pertanyan yang belum dia kuasai <br> terima kasih orang baik :) </small>
                          </div>
                      </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </x-slot>
</x-mazer-layout>