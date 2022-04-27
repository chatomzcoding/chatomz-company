<div class="card">
    <div class="card-header">
        <h4>Gempa Terkini</h4>
    </div>
    <div class="card-body">
        @if ($data)
            <section>
                <img src="https://data.bmkg.go.id/DataMKG/TEWS/{{ $data->Infogempa->gempa->Shakemap }}" alt="" class="img-fluid">
            </section>
            @foreach ($data->Infogempa->gempa as $key => $data)
                @if ($key <> 'Shakemap')
                    {{ $data }} <br>
                @endif
            @endforeach
        @else
            <section class="text-center">
                <i>tidak ada data</i>
            </section>
        @endif
    </div>
</div>