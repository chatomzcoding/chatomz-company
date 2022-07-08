<x-mazer-layout title="CHATOMZ - PENCARIAN" select="TRUE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header :head="$judul ?? ''">
            </x-header>
            <div class="section">
                @forelse ($data as $label => $d)
                    @if (count($d) > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="text-uppercase">{{ $label }}</strong>
                                        <span class="float-end">Total {{ count($d) }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row d-flex align-items-stretch mt-3">
                                            @forelse ($d as $item)
                                                <div class="col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                                                    <div class="card mb-3 w-100">
                                                        <div class="row no-gutters">
                                                            <div class="col-md-4 text-center">
                                                                @if (file_exists('public/'.$item['photo']))
                                                                    {{-- <a href="{{ asset($item['photo']) }}" target="_blank"> --}}
                                                                    <a href="#" data-link="{{ asset($item['photo']) }}" data-bs-toggle="modal" data-bs-target="#photo">
                                                                        <img src="{{ asset($item['photo']) }}" class="card-img" alt="...">
                                                                    </a>
                                                                @else
                                                                    <img src="{{ asset('img/null.png') }}" alt="" class="card-img">
                                                                @endif
                                                            </div>
                                                           
                                                        <div class="col-md-8 pt-0 px-0">
                                                            <div class="card-body px-2 pt-0">
                                                            <h6 class="small text-capitalize">
                                                                <a href="{{ url($item['link']) }}">
                                                                    {!! $item['nama'] !!}
                                                                </a>
                                                            </h6>
                                                                <small class="text-muted">{{ $item['info'] }}</small>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col text-center">
                                                    <i>Data tidak ada</i>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="row">
                        <div class="col text-center">belum ada</div>
                    </div>
                @endforelse
            </div>
        </div>
    </x-slot>
    <x-slot name="kodejs">
        <x-modal id="photo" size="modal-lg">
            <section>
                <img src="" alt="" id="link" class="w-100">
            </section>
        </x-modal>
        <script>
            $('#photo').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var link = button.data('link')
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #link').attr("src",link);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
