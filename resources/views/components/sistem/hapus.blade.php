<button onclick="deleteRow( {{ $id }} )" class="btn btn-outline-danger btn-sm"><i class="bi-trash"></i></button>
<form id="data-{{ $id }}" action="{{url($url,$id)}}" method="post">
    @csrf
    @method('delete')
    </form>   