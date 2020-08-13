@if(isset($no_header))
@else
	@include($viewBase . '.header')
@endif


<div class="container-fluid" id="{{ $comp_orginal_id }}">
	<div class="row">
    	@yield('content')
	</div>
</div>