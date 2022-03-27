<x-singel-layout title="CHATOMZ - STATISTIK" back="orang">
    <x-slot name="content">
        <div class="card">
            <div class="card-header">
                <h3 class="text-capitalize">Statisik Analisis</h3>
                <p>{{ $judul ?? '' }}
                {{-- <span class="badge bg-info float-end">Total {{ count($orang) }}</span> --}}
                </p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="kelengkapandata-tab" data-bs-toggle="pill"
                                href="#kelengkapandata" role="tab" aria-controls="kelengkapandata"
                                aria-selected="true">Kelengkapan Data</a>
                            <a class="nav-link" id="fasekehidupan-tab" data-bs-toggle="pill"
                                href="#fasekehidupan" role="tab" aria-controls="fasekehidupan"
                                aria-selected="false">Fase Kehidupan</a>
                            <a class="nav-link" id="statusagama-tab" data-bs-toggle="pill" href="#statusagama" role="tab" aria-controls="statusagama" aria-selected="false">Agama</a>
                            <a class="nav-link" id="v-goldar-tab" data-bs-toggle="pill" href="#v-goldar" role="tab" aria-controls="v-goldar"aria-selected="false">Golongan Darah</a>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="kelengkapandata" role="tabpanel"
                                aria-labelledby="kelengkapandata-tab">
                                <x-taborang :orang="$data['kelengkapandata']" id="sesidata" tab="tabdata" konten="data" showchart="chartbiodata">
                                </x-taborang>
                            </div>
                            <div class="tab-pane fade" id="fasekehidupan" role="tabpanel"
                                aria-labelledby="fasekehidupan-tab">
                                <x-taborang :orang="$data['fasekehidupan']" id="sesifase" tab="tabfase" konten="fase" showchart="chartfase"></x-taborang>
                            </div>
                            <div class="tab-pane fade" id="statusagama" role="tabpanel"
                                aria-labelledby="statusagama-tab">
                               <x-taborang :orang="$data['agama']" id="sesiagama" tab="tabagama" photo="FALSE">
                                </x-taborang>
                            </div>
                            <div class="tab-pane fade" id="v-goldar" role="tabpanel"
                                aria-labelledby="v-goldar-tab">
                                <x-taborang :orang="$data['goldar']" id="sesigoldar" tab="tabgoldar" showchart="chartgoldar">
                                </x-taborang>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- ubah anggota grup --}}
    <x-modalubah judul="Edit Orang" link="orang" size="modal-lg">
        <input type="hidden" name="perbaharui" value="TRUE">
        <section class="p-3 row">
            <div class="col">
                <div class="form-group">
                    <label for="inlineinput">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" readonly>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Alamat Rumah</label>
                        <textarea name="home_address" id="home_address" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Tempat Lahir</label>
                        <input type="text" name="place_birth" class="form-control" id="place_birth">
                </div>
                <div class="form-group">
                    <label for="inlineinput">Tanggal Lahir</label>
                        <input type="date" name="date_birth" class="form-control" id="date_birth">
                </div>
                <div class="form-group">
                    <label for="inlineinput">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="laki-laki">Laki - laki</option>
                            <option value="perempuan">Perempuan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Golongan Darah</label>
                        <select name="blood_type" id="blood_type" class="form-control">
                            @foreach (kingdom_goldar() as $item)
                            <option value="{{ $item}}">{{ strtoupper($item)}}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="inlineinput">Status Perkawinan</label>
                        <select name="marital_status" id="marital_status" class="form-control">
                            <option value="belum">Belum Kawin</option>
                            <option value="sudah">Sudah Kawin</option>
                            <option value="pernah">Pernah Kawin</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Grup Status</label>
                        <select name="status_group" id="status_group" class="form-control">
                            <option value="available">Tersedia</option>
                            <option value="full">Ditutup</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Status Kematian</label>
                        <select name="death" id="death" class="form-control">
                            <option value="">Masih Hidup</option>
                            <option value="alm">Meninggal</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="inlineinput">Catatan</label>
                    <input type="text" name="note" class="form-control" id="note">
                </div>
                <div class="form-group">
                    <label for="inlineinput">Photo</label>
                        <input type="file" name="photo" class="form-control">
                        <span class="text-danger">input jika ingin mengubah photo</span>
                </div>
            </div>
        </section>
    </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var nama = button.data('nama')
                var home_address = button.data('home_address')
                var place_birth = button.data('place_birth')
                var date_birth = button.data('date_birth')
                var gender = button.data('gender')
                var death = button.data('death')
                var status_group = button.data('status_group')
                var note = button.data('note')
                var blood_type = button.data('blood_type')
                var marital_status = button.data('marital_status')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #home_address').val(home_address);
                modal.find('.modal-body #place_birth').val(place_birth);
                modal.find('.modal-body #date_birth').val(date_birth);
                modal.find('.modal-body #gender').val(gender);
                modal.find('.modal-body #death').val(death);
                modal.find('.modal-body #status_group').val(status_group);
                modal.find('.modal-body #note').val(note);
                modal.find('.modal-body #blood_type').val(blood_type);
                modal.find('.modal-body #marital_status').val(marital_status);
                modal.find('.modal-body #id').val(id);
            })
        </script>
        <script src="{{ asset('template/mazer/vendors/apexcharts/apexcharts.js')}}"></script>
        <script type="text/javascript">
            let dataagama  = {
                series: [40,50],
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
            let datafase  = {
                series: @json($chart['fase']['data']),
                labels: @json($chart['fase']['label']),
                // colors: ['#435ebe','#55c6e8'],
                chart: {
                    type: 'donut',
                    width: '100%',
                    height:'500px'
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
            let datagoldar  = {
                series: @json($chart['goldar']['data']),
                labels: @json($chart['goldar']['label']),
                // colors: ['#435ebe','#55c6e8'],
                chart: {
                    type: 'donut',
                    width: '100%',
                    height:'500px'
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
            var chartbiodata = new ApexCharts(document.getElementById('chartbiodata'), dataagama)
            var chartfase = new ApexCharts(document.getElementById('chartfase'), datafase)
            var chartgoldar = new ApexCharts(document.getElementById('chartgoldar'), datagoldar)
            chartbiodata.render()
            chartgoldar.render()
        </script>
       
    </x-slot>


</x-singel-layout>