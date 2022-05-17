<x-mazer-layout title="DUNIA PHONE" alert="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Informasi Phone" active="Detail {{ $informasisub->nama_sub }}" :hyperlink="['informasi' => 'informasi','daftar brand' =>'informasi?id='.$informasisub->informasi->kategori_id, $informasisub->informasi->nama => 'informasi/'.$informasisub->informasi->id]"></x-header>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <header class="bg-white mb-2 p-2 rounded">
                            <x-sistem.kembali url="informasi/{{ $informasisub->informasi->id}}"></x-sistem.kembali>
                        </header>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mt-2">
                                    <div class="card-content">
                                        <a href="{{ asset('img/company/informasi/phone/'.$informasisub->gambar_sub)}}" target="_blank"><img src="{{ asset('img/company/informasi/phone/'.$informasisub->gambar_sub)}}" alt="phone" class="card-img-top img-fluid"></a> <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            {{ ucwords($informasisub->nama_sub)}}
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                                    role="tab" aria-controls="home" aria-selected="true">Deskripsi</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                                    role="tab" aria-controls="profile" aria-selected="false">Spefisikasi</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact"
                                                    role="tab" aria-controls="contact" aria-selected="false">Detail Lengkap</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                                aria-labelledby="home-tab">
                                                <section class="mt-2">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <th>Release</th>
                                                            <td>{{ $detail->release_date }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sistem Operasi</th>
                                                            <td>{{ $detail->os }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dimensi</th>
                                                            <td>{{ $detail->dimension }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Penyimpanan</th>
                                                            <td>{{ $detail->storage }}</td>
                                                        </tr>
                                                    </table>
                                                </section>
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel"
                                                aria-labelledby="profile-tab">
                                                <section class="mt-2">
                                                    {{-- simple --}}
                                                    <table class="table table-borderless">
                                                        @foreach ($detail->specifications as $item)
                                                            <tr>
                                                                <th colspan="2" class="table-primary">{{ $item->title }}</th>
                                                            </tr>
                                                            @foreach ($item->specs as $i)
                                                            <tr>
                                                                <th class="ps-5">{{ $i->key }}</th>
                                                                <td>
                                                                    <small>
                                                                        @forelse ($i->val as $j)
                                                                            {{ $j }}
                                                                        @empty
                                                                            
                                                                        @endforelse
                                                                    </small>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </table>
                                                </section>
                                            </div>
                                            <div class="tab-pane fade" id="contact" role="tabpanel"
                                                aria-labelledby="contact-tab">
                                                <section class="mt-2">
                                                    <table class="w-100">
                                                        @foreach ($detail->specifications as $item)
                                                            <tr>
                                                                <th class="w-25">{{ $item->title }}</th>
                                                                <td>
                                                                    @foreach ($item->specs as $i)
                                                                        <strong>{{ $i->key }}</strong> <br>
                                                                        <small>
                                                                            @forelse ($i->val as $j)
                                                                                {{ $j }}
                                                                            @empty
                                                                                
                                                                            @endforelse
                                                                        </small> <br>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </section>
                                            </div>
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
</x-mazer-layout>