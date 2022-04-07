<x-mazer-layout title="CHATOMZ - Bot" alert="TRUE" datatables="TRUE" select="TRUE">
    <x-slot name="content">
        <div class="page-heading">
            <x-header head="Data Chatomz Bot" active="Daftar Chatomz Bot"></x-header>
            <div class="section">
                <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                    <div class="card-header">
                        {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                        <a href="#" class="btn btn-outline-primary btn-flat btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah Bot </a>
                        <a href="{{ url('chatomzbot?cek=true') }}" class="btn btn-outline-dark btn-flat btn-sm"><i class="fas fa-file"></i> Test Bot </a>
                    </div>
                    <div class="card-body">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                    <option value="valid" @if ($main['filter']['status'] == 'valid')
                                                        selected
                                                    @endif>VALID</option>
                                                    <option value="proses" @if ($main['filter']['status'] == 'proses')
                                                        selected
                                                    @endif>PROSES</option>
                                                    <option value="filter" @if ($main['filter']['status'] == 'filter')
                                                        selected
                                                    @endif>KATA FILTER</option>
                                                    <option value="default" @if ($main['filter']['status'] == 'default')
                                                        selected
                                                    @endif>KATA DEFAULT</option>
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                            </form>  
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Aksi</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    @forelse ($bots as $item)
                                    <tr>
                                            <td class="text-center">{{ $loop->iteration}}</td>
                                            <td class="text-center">
                                                <x-aksi :id="$item->id" link="chatomzbot">
                                                    <button type="button" data-bs-toggle="modal"  data-pertanyaan="{{ $item->pertanyaan }}"  data-jawaban="{{ $item->jawaban }}"  data-status="{{ $item->status }}"  data-id="{{ $item->id }}" data-bs-target="#ubah" title="" class="dropdown-item text-success" data-original-title="Edit Task">
                                                        <i class="fa fa-edit" style="width: 20px;"></i> EDIT
                                                    </button>
                                                </x-aksi>
                                            </td>
                                            <td>
                                                @if ($item->status == 'valid')
                                                    <ul>
                                                        @foreach (json_decode($item->pertanyaan) as $k)
                                                            <li>{{ $k }}?</li>
                                                        @endforeach
                                                    </ul>
                                                    
                                                @else
                                                    {{ $item->pertanyaan }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->jawaban}}
                                            </td>
                                            <td class="text-center">{{ $item->status}}</td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="5">tidak ada data</td>
                                        </tr>
                                    @endforelse
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <x-modalsimpan judul="Tambah Pengetahuan ke Bot" link="chatomzbot">
            <input type="hidden" name="status" value="{{ $main['filter']['status'] }}">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Pertanyaan {!! ireq() !!}</label>
                    <textarea name="pertanyaan" id="pertanyaan" cols="30" rows="5" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Jawaban {!! ireq() !!}</label>
                    <textarea name="jawaban" id="jawaban" cols="30" rows="4" class="form-control" required></textarea>
                </div>
            </section>
        </x-modalsimpan>
        <x-modalubah judul="Edit Bot" link="chatomzbot">
            <section class="p-3">
                <div class="form-group">
                    <label for="">Nama Pertanyaan {!! ireq() !!}</label>
                    <textarea name="pertanyaan" id="pertanyaan" cols="30" rows="5" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Arahkan ke jawaban</label>
                        <select name="datajawaban" id="datajawaban" class="select2bs4 form-control" data-width="100%" required>
                            <option value="tidak">tidak ada</option>
                            @foreach ($botvalid as $item)
                                <option value="{{ $item->id }}">{{ $item->jawaban }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label for="">Jawaban</label>
                    <textarea name="jawaban" id="jawaban" cols="30" rows="4" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Status {!! ireq() !!}</label>
                    <select name="status" id="{{ ($main['filter']['status'] == 'proses') ? '' : 'status' }}" class="form-control" required>
                        <option value="valid">VALID</option>
                        <option value="proses">PROSES</option>
                        <option value="filter">KATA FILTER</option>
                        <option value="default">KATA DEFAULT</option>
                    </select>
                </div>
            </section>
        </x-modalubah>
    </x-slot>
    <x-slot name="kodejs">
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var pertanyaan = button.data('pertanyaan')
                var jawaban = button.data('jawaban')
                var status = button.data('status')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #pertanyaan').val(pertanyaan);
                modal.find('.modal-body #jawaban').val(jawaban);
                modal.find('.modal-body #status').val(status);
                modal.find('.modal-body #id').val(id);
            })
        </script>
    </x-slot>
</x-mazer-layout>
