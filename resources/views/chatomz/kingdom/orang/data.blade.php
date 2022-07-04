@forelse ($orang as $item)
<div class="col-md-2 post-id" id="{{ $item->id }}">
    <div class="card w-100">
        <a href="{{ url('/orang/'.Crypt::encryptString($item->id))}}" target="_blank"><img src="{{ asset('/img/chatomz/orang/'.orang_photo($item->photo))}}" class="card-img-top" alt="..."></a>
        <div class="card-body p-1 text-center">
        <small class="text-capitalize">{{ $item->first_name.' '.$item->last_name}}</small>
        {{-- <p class="card-text">{{ $item->home_address}}</p> --}}
        </div>
    </div>
</div>
@empty
<div class="col-md-12">
<div class="alert alert-warning text-center">
    tidak ada data
</div>
</div>
@endforelse