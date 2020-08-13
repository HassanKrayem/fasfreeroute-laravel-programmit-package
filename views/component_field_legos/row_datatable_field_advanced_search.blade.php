<form id="comp_lego_entity_search_date_form">
<div class="row">
	<div class="col-12"><hr></div>

	@yield('row_datatable_field_advanced_search_extra_fields', '')
	
	{{-- Data from --}}
	<div class="col-12 col-sm-3">
		<div class="form-group row m-0">
	 		<label class="col-12 col-sm-2 col-form-label pl-1 text-success">From</label>
	  		<div class="col-12 col-sm-10">
	    		<input class="form-control" id="comp_datatable_field_data_search_from" type="text" placeholder="Select Date" readonly="">
	  		</div>
    	</div>
	</div>

	{{-- Data to --}}
	<div class="col-12 col-sm-3">
		<div class="form-group row m-0">
	 		<label class="col-12 col-sm-2 col-form-label pl-1 text-success">To</label>
	  		<div class="col-12 col-sm-10">
	    		<input class="form-control" id="comp_datatable_field_data_search_to" type="text" placeholder="Select Date" readonly="">
	  		</div>
    	</div>
	</div>

	{{-- Laravel Database Search --}}
	<div class="col-12 col-sm-3">
	    <div class="form-group row m-0">
	     <label class="col-12 col-sm-4 col-form-label pl-1 text-info">@yield('laravel_database_search_text', 'Search DB')</label>
	      <div class="col-12 col-sm-8 mb-3">
	        <input type="text" list="@yield('laravel_database_search_list', '')" class="form-control p-1 pl-2" id="comp_datatable_field_data_search_text" placeholder="{{$comp_search_query}}" value="" autofocus>
	      </div>
	    </div>
  	</div>

	<div class="col-12 col-sm-3">
		<button class="btn btn-primary" id="comp_datatable_field_data_search_go" type="button"><i class="fa fa-fw fa-lg fa-search"></i>Search</button>
	</div>
</div>
</form>

<script type="text/javascript">
$('#comp_datatable_field_data_search_from').datepicker({
  	format: "dd/mm/yyyy",
  	autoclose: true,
  	todayHighlight: true,
  	changeMonth: true,
    changeYear: true,
    autoSize: true,
  }).datepicker('setDate', getLastWeek());

$('#comp_datatable_field_data_search_to').datepicker({
  	format: "dd/mm/yyyy",
  	autoclose: true,
  	todayHighlight: true,
  	defaultDate: new Date(),
  }).datepicker("setDate",new Date());;


_('comp_datatable_field_data_search_go').onclick = function()
{
	dform = $('#comp_datatable_field_data_search_from').datepicker('getDate');
	dend   = $('#comp_datatable_field_data_search_to').datepicker('getDate');
	days   = parseInt((dend - dform)/1000/60/60/24);
	if(days <= 0)
		swal.fire('Attention','"From" date must be before "To" date.','warning');

	@yield('row_datatable_field_advanced_search_validation_js', '')

	// alert($('#comp_datatable_field_data_search_from').val());
	componentRefresh('{{$view_controller}}.partial_list', {
		'comp_search_date_from' : $('#comp_datatable_field_data_search_from').val(),
		'comp_search_date_to' : $('#comp_datatable_field_data_search_to').val(),
		'comp_search_query': _('comp_datatable_field_data_search_text').value,
		@yield('row_datatable_field_advanced_search_component_refresh_data', '')
	});
}

function getLastWeek() {
  var today = new Date();
  var lastWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 7);
  return lastWeek;
}
</script>