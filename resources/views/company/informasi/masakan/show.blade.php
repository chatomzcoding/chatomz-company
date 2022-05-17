<x-mazer-layout title="DUNIA MASAKAN" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Resep Masakan" active="Detail Resep Masakan"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <x-sistem.kembali url="informasi?id={{ $informasi->kategori->id}}"></x-sistem.kembali>
                            <x-sistem.hapus :id="$informasi->id" url="informasi"></x-sistem.hapus>
                        </header>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-content">
                                        <a href="{{ asset('img/company/informasi/masakan/'.$informasi->gambar)}}" target="_blank"><img src="{{ asset('img/company/informasi/masakan/'.$informasi->gambar) }}" alt="gambar masakan" class="card-img-top img-fluid"></a> <br>
                                        <section class="text-center py-2">
                                            {{ ucwords($informasi->nama)}} <br>
                                            @if (isset($detail->author))
                                                <small>Resep Dari {{ $detail->author->user }}</small><br>
                                                <small>{{ $detail->author->datePublished }}</small>
                                            @endif
                                        </section>
                                        <hr>
                                        <section class="p-2 small">
                                            <dd>
                                                @if (isset($detail->servings))
                                                    <dl>Untuk {{ $detail->servings }}</dl>
                                                @endif
                                                @if (isset($detail->times))
                                                    <dl>Estimasi Pembuatan {{ $detail->times }}</dl>
                                                @endif
                                                @if (isset($detail->dificulty))
                                                    <dl>Tingkat Resep {{ $detail->dificulty }}</dl>
                                                @endif
                                            </dd>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                               <div class="card">
                                   <div class="card-body p-2">
                                       <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                         Deskripsi Masakan
                                       </button>
                                     <div class="collapse mt-2" id="collapseExample">
                                       <div class="card card-body">
                                           <small>{{ $detail->desc }}</small>
                                       </div>
                                     </div>
                                   </div>
                               </div>
                               <div class="card mt-2">
                                    <div class="card">
                                        <div class="card-header p-2">
                                            <strong>Bahan - Bahan</strong>
                                        </div>
                                        <div class="card-body pb-0">
                                            <ul>
                                                @foreach ($detail->ingredient as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                               </div>
                               <div class="card mt-2">
                                    <div class="card">
                                        <div class="card-header p-2">
                                            <strong>Langkah Pembuatan</strong>
                                        </div>
                                        <div class="card-body pb-0">
                                            <dd>
                                                @foreach ($detail->step as $item)
                                                    <dl>{{ $item }}</dl>
                                                @endforeach
                                            </dd>
                                        </div>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            });
        </script>

    </x-slot>
</x-mazer-layout>