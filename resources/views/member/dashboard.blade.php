<x-mazer-layout title="Dashboard - Chatomz Company">
    <x-slot name="content">
        <div class="page-heading">
            <h3>Statistik</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-6 col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                              <a href="{{ url('orang') }}">
                                                  <div class="stats-icon purple">
                                                      <i class="bi-person"></i>
                                                  </div>
                                              </a>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Orang</h6>
                                            <h6 class="font-extrabold mb-0 small">{{ $statistik['orang'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                          <a href="{{ url('keluarga') }}">
                                            <div class="stats-icon green">
                                                <i class="bi-people"></i>
                                            </div>
                                          </a>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Keluarga</h6>
                                            <h6 class="font-extrabold mb-0 small">{{ $statistik['keluarga'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- <section class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jumlah View Pengunjung Website ({{ bulan_indo().' '.ambil_tahun() }})</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-visitor"></div>
                        </div>
                    </div>
                </div>
            </section> --}}
        </div>
    </x-slot>
  </x-mazer-layout>
  
  
  