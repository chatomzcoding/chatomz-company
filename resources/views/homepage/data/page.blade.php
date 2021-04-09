 <div class="product__pagination text-center">
    @if ($paginator->onFirstPage())
        <a href="#"><i class="fas fa-long-arrow-alt-left"></i></a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-long-arrow-alt-left"></i></a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <a href="#" class="bg-success text-white">{{ $element }}</a>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href="#" class="bg-success text-white disabled">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-long-arrow-alt-right"></i></a>
    @else
        <a href="#"><i class="fas fa-long-arrow-alt-right"></i></a>
    @endif
    <div>
        <hr>
        <p class="text-sm text-gray-700 leading-5">
            {!! __('Menampilkan') !!}
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('-') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            {!! __('dari') !!}
            <span class="font-medium">{{ $paginator->total() }}</span>
            {!! __('total') !!}
        </p>
    </div>
</div>
{{-- <nav aria-label="Page navigation example">
    <ul class="pagination  justify-content-center">
        @if ($paginator->onFirstPage())
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
        @endif

        @foreach ($elements as $element)
        @if (is_string($element))
          <li class="page-item"><a class="page-link" href="#">{{ $element }}</li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }} <span class="sr-only">(current)</span> </span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

      @if ($paginator->hasMorePages())
      <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a></li>
    @else
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
    @endif
    </ul>
    <div>
        <p class="text-sm text-gray-700 leading-5">
            {!! __('Menampilkan') !!}
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('-') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            {!! __('dari') !!}
            <span class="font-medium">{{ $paginator->total() }}</span>
            {!! __('total') !!}
        </p>
    </div>
</nav> --}}