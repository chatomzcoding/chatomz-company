<div class="card">
    <div class="card-header">
        <h4>Jurnal Hari ini</h4>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tbody>
                @forelse ($data as $item)
                    <tr class="text-{{ keuanganWarnaArus($item->arus) }}">
                        <td><a href="{{ url('jurnal/'.$item->id) }}">{{ ucwords($item->nama_jurnal) }}</a> <br> <i class="small text-muted">{{ $item->rekening->nama_rekening.' - '.$item->subkategori->nama_sub }}</i></td>
                        <td class="text-end ">{{ norupiah($item->nominal) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>