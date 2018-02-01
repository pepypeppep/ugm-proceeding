{{-- Blade pagination generator. Include this layout, and pass the API response. --}}
@if ($response->meta['last_page'] != 1)
	<nav class="mt-4" aria-label="Page navigation example">
	  <ul class="pagination justify-content-center">
	    <li class="page-item @if($response->meta['current_page'] == 1) disabled @endif">
	      <a class="page-link" href="{{ $response->previousPage() }}" tabindex="-1">Previous</a>
	    </li>
	    @for ($i = 1; $i <= $response->meta['last_page']; $i++)
	      <li class="page-item @if($i == $response->meta['current_page']) active @endif)"><a class="page-link" href="{{ $response->page($i) }}">{{ $i }}</a></li>
	    @endfor
	    <li class="page-item @if($response->meta['current_page'] == $response->meta['last_page']) disabled @endif">
	      <a class="page-link" href="{{ $response->nextPage() }}">Next</a>
	    </li>
	  </ul>
	</nav>
@endif