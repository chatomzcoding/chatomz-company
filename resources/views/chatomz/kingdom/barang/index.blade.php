<x-mazer-layout title="CHATOMZ - Daftar Barang" alert="TRUE">
    <x-slot name="content">
      <div class="page-heading">
        <x-header head="Data Barang" active="Daftar Barang"></x-header>
        <div class="section">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body p-2">
                  <x-sistem.tambah url='/barang/create'></x-sistem.tambah>
                  <a href="{{ url('barang?s=dashboard') }}" class="btn btn-outline-info btn-sm"><i class="bi-bar-chart"></i></a>
                </div>
              </div>
                  <div class="row">
                      @forelse ($barang as $item)
                      <div class="col-md-2">
                        <form id="data-{{ $item->id }}" action="{{url('/barang',$item->id)}}" method="post">
                          @csrf
                          @method('delete')
                          </form>   
                          <div class="card w-100 position-relative">
                              <a href="{{ url('/barang/'.$item->id)}}"><img src="{{ asset('img/chatomz/barang/'.$item->mg_barang)}}" class="card-img-top" alt="{{ $item->photo_barang }}"></a>
                              <div class="card-body p-1 text-center">
                              <small class="text-capitalize">{{ $item->nama_barang}}</small>
                            </div>
                              <button onclick="deleteRow( {{ $item->id }} )" class="btn btn-danger btn-sm position-absolute top-0 end-0"><i class="bi-trash"></i></button>
                          </div>
                      </div>
                      @empty
                      <div class="col">
                          <p>tidak ada data</p>
                      </div>
                      @endforelse
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <x-modalubah judul="Edit Barang" link="barang">
        <section class="p-3">
          <div class="form-group row">
              <label for="" class="col-md-4">Nama Barang</label>
              <input type="text" name="nama_barang" id="nama_barang" class="form-control col-md-8" required>
         </div>
         <div class="form-group row">
              <label for="" class="col-md-4">Photo</label>
              <input type="file" name="photo_barang" class="form-control col-md-8">
         </div>
      </section>
      </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
      <script>
          $('#ubah').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget)
              var nama_barang = button.data('nama_barang')
              var id = button.data('id')

              var modal = $(this)

              modal.find('.modal-body #nama_barang').val(nama_barang);
              modal.find('.modal-body #id').val(id);
          })
      </script>
    </x-slot>
</x-mazer-layout>
