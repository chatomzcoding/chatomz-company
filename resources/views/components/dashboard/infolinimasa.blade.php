<div class="card">
    <div class="card-header pb-0">
        <h4>Lini Masa</h4>
        <p class="small text-info fst-italic">Hari ini dan masa yang akan datang</p>
    </div>
    <div class="card-body rounded pb-0">
        <table class="table table-borderless">
            @forelse ($data as $item)
                <tr>
                    <td>
                        <a href="{{ url('orang/'.Crypt::encryptString($item->orang->id)) }}">
                            <i class="bi-{{ $item->icon }}"></i> {{ ucfirst($item->nama) }} <br>
                            <small class="text-muted">{{ fullname($item->orang).', '.date_indo($item->tanggal).' - '.$item->jam }} </small>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center"><i>belum ada data</i></td>
                </tr>
            @endforelse
        </table>
    </div>
</div>