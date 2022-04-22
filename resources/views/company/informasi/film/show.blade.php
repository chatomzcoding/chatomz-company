<x-mazer-layout title="DUNIA FILM" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Film" active="Daftar Film"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <a href="{{ url('informasi?id='.$informasi->kategori->id) }}" class="btn btn-outline-secondary btn-flat btn-sm"><i class="bi-arrow-left"></i> Kembali </a>
                        </header>
                    </div>
                    <div class="col-md-12">
                        @php
                            $detail = json_decode($informasi->detail,TRUE); 
                            $key    = array_keys($detail);
                            $filter = ['Ratings','Poster','imdbID','Response','Website','DVD','BoxOffice'];
                        @endphp
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-content">
                                        <a href="{{ asset('img/company/informasi/film/'.$informasi->gambar)}}" target="_blank"><img src="{{ asset('img/company/informasi/film/'.$informasi->gambar)}}" alt="user-avatar" class="card-img-top img-fluid"></a> <br>
                                    <section class="text-center py-2">
                                        {{ ucwords($informasi->nama)}} <br>
                                    </section>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ol class="list-group list-group-numbered">
                                    @for ($i = 0; $i < count($key); $i++)
                                        @if (!in_array($key[$i],$filter))
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">{{ $key[$i] }}</div>
                                                    {{ $detail[$key[$i]] }}
                                                </div>
                                                {{-- <span class="badge bg-primary rounded-pill">14</span> --}}
                                            </li>
                                        @endif
                                    @endfor
                                </ol>
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