<x-mazer-layout title="Dashboard - Chatomz Company">
  <x-slot name="content">
      <div class="page-heading">
          <h3>Statistik</h3>
      </div>
      <div class="page-content">
          <section class="row">
              <div class="col-md-12">
              </div>
              <div class="col-12 col-lg-9">
                  <div class="row">
                      <div class="col-6 col-lg-3 col-md-6">
                          <div class="card">
                              <div class="card-body px-3 py-4-5">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="stats-icon purple">
                                              <i class="bi-person"></i>
                                          </div>
                                      </div>
                                      <div class="col-md-8">
                                          <h6 class="text-muted font-semibold">Orang</h6>
                                          <h6 class="font-extrabold mb-0">{{ $total['orang'] }}</h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-6">
                          <div class="card">
                              <div class="card-body px-3 py-4-5">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="stats-icon blue">
                                              <i class="bi-person-badge"></i>
                                          </div>
                                      </div>
                                      <div class="col-md-8">
                                          <h6 class="text-muted font-semibold">Grup</h6>
                                          <h6 class="font-extrabold mb-0">{{ $total['grup'] }}</h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-6">
                          <div class="card">
                              <div class="card-body px-3 py-4-5">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="stats-icon green">
                                              <i class="bi-people"></i>
                                          </div>
                                      </div>
                                      <div class="col-md-8">
                                          <h6 class="text-muted font-semibold">Keluarga</h6>
                                          <h6 class="font-extrabold mb-0">{{ $total['keluarga'] }}</h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-6 col-lg-3 col-md-6">
                          <div class="card">
                              <div class="card-body px-3 py-4-5">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="stats-icon red">
                                              <i class="bi-geo"></i>
                                          </div>
                                      </div>
                                      <div class="col-md-8">
                                          <h6 class="text-muted font-semibold">Jejak</h6>
                                          <h6 class="font-extrabold mb-0">{{ $total['jejak'] }}</h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  <h4>Jumlah Pengunjung Website (maintenance)</h4>
                              </div>
                              <div class="card-body">
                                  <div id="chart-profile-visit"></div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-12 col-xl-6">
                          <x-dashboard.infogempa/>
                      </div>
                      <div class="col-12 col-xl-6">
                          <div class="card">
                              <div class="card-header">
                                  <h4>Terakhir Dilihat</h4>
                              </div>
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table table-hover table-lg">
                                          {{-- <thead>
                                              <tr>
                                                  <th>Nama</th>
                                                  <th>Comment</th>
                                              </tr>
                                          </thead> --}}
                                          <tbody>
                                              @forelse ($data['riwayatlihatorang'] as $item)
                                              @if (isset($item->orang))
                                                <tr>
                                                    <td class="col-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <a href="{{ url('orang/'.Crypt::encryptString($item->orang->id)) }}"><img src="{{ asset('img/chatomz/orang/'.$item->orang->photo)}}"></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">{{ fullname($item->orang) }}</p>
                                                        <i>{{ $item->detail }}</i>
                                                    </td>
                                                </tr>
                                                  
                                              @else
                                                  <tr>
                                                      <td colspan="2"><i>Data Orang telah dihapus</i></td>
                                                  </tr>
                                              @endif
                                              @empty
                                              <tr>
                                                  <td colspan="2" class="text-center">
                                                     <i>belum ada data</i>
                                                  </td>
                                              </tr>
                                              @endforelse
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-12 col-lg-3">
                  <div class="card">
                      <div class="card-body py-4 px-5">
                         <x-chatomz.profil/>
                      </div>
                  </div>
                  <div class="card">
                      <div class="card-header">
                          <h4>Ulang Tahun Hari ini</h4>
                      </div>
                      <div class="card-content pb-4">
                          @forelse ($info['ulangtahuntanggalini'] as $item)
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('img/chatomz/orang/'.orang_photo($item->photo))}}">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">{{ fullname($item) }}</h5>
                                    {{-- <h6 class="text-muted mb-0">@johnducky</h6> --}}
                                </div>
                            </div>
                          @empty
                          <div class="text-center">
                              <small>tidak ada</small>
                          </div>
                          @endforelse
                          @if (count($info['ulangtahuntanggalini']))
                            <div class="px-4">
                                <form action="{{ url('pencarian') }}" method="get">
                                    @csrf
                                    <input type="hidden" name="s" value="ulangtahuntanggalini">
                                    <button type="submit" class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Selengkapnya</button>
                                </form>
                            </div>
                          @endif
                      </div>
                  </div>
                  <div class="card">
                      <div class="card-header">
                          <h4>Perbandingan Orang</h4>
                      </div>
                      <div class="card-body">
                          <div id="chart-visitors-profile"></div>
                          <div id="chart-kematian"></div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
  </x-slot>

  <x-slot name="kodejs">
        <script src="{{ asset('template/mazer/vendors/apexcharts/apexcharts.js')}}"></script>
        <script type="text/javascript">
            var optionsProfileVisit = {
                annotations: {
                    position: 'back'
                },
                dataLabels: {
                    enabled:false
                },
                chart: {
                    type: 'bar',
                    height: 300
                },
                fill: {
                    opacity:1
                },
                plotOptions: {
                },
                series: [{
                    name: 'sales',
                    data: [9,20,30,20,10,20,30,20,10,20,30,20]
                }],
                colors: '#435ebe',
                xaxis: {
                    categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul", "Aug","Sep","Oct","Nov","Dec"],
                },
            }
            let perbandinganjeniskelamin  = {
                series: @json($gender),
                labels: ['Laki-laki', 'Perempuan'],
                colors: ['#435ebe','#55c6e8'],
                chart: {
                    type: 'donut',
                    width: '100%',
                    height:'350px'
                },
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '30%'
                        }
                    }
                }
            }
            let perbandingankematian  = {
                series: @json($kematian),
                labels: ['Masih Hidup', 'Meninggal'],
                colors: ['#435ebe','#55c6e8'],
                chart: {
                    type: 'donut',
                    width: '100%',
                    height:'350px'
                },
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '30%'
                        }
                    }
                }
            }

            var optionsEurope = {
                series: [{
                    name: 'series1',
                    data: [310, 800, 600, 430, 540, 340, 605, 805,430, 540, 340, 605]
                }],
                chart: {
                    height: 80,
                    type: 'area',
                    toolbar: {
                        show:false,
                    },
                },
                colors: ['#5350e9'],
                stroke: {
                    width: 2,
                },
                grid: {
                    show:false,
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    type: 'datetime',
                    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z","2018-09-19T07:30:00.000Z","2018-09-19T08:30:00.000Z","2018-09-19T09:30:00.000Z","2018-09-19T10:30:00.000Z","2018-09-19T11:30:00.000Z"],
                    axisBorder: {
                        show:false
                    },
                    axisTicks: {
                        show:false
                    },
                    labels: {
                        show:false,
                    }
                },
                show:false,
                yaxis: {
                    labels: {
                        show:false,
                    },
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };

            let optionsAmerica = {
                ...optionsEurope,
                colors: ['#008b75'],
            }
            let optionsIndonesia = {
                ...optionsEurope,
                colors: ['#dc3545'],
            }

            var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
            var chartjeniskelamin = new ApexCharts(document.getElementById('chart-visitors-profile'), perbandinganjeniskelamin)
            var chartkematian = new ApexCharts(document.getElementById('chart-kematian'), perbandingankematian)
            var chartEurope = new ApexCharts(document.querySelector("#chart-europe"), optionsEurope);
            var chartAmerica = new ApexCharts(document.querySelector("#chart-america"), optionsAmerica);
            var chartIndonesia = new ApexCharts(document.querySelector("#chart-indonesia"), optionsIndonesia);

            chartIndonesia.render();
            chartAmerica.render();
            chartEurope.render();
            chartProfileVisit.render();
            chartjeniskelamin.render()
            chartkematian.render()
        </script>
  </x-slot>

</x-mazer-layout>


