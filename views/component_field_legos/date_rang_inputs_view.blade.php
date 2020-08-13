<label class="col-12 col-sm-1 col-form-label pl-1 text-success">From</label>
<div class="col-12 col-sm-2">
	<input class="form-control" id="{{ $input_from_id }}" type="text" placeholder="Select Date" readonly="">
</div>

<label class="col-12 col-sm-1 col-form-label pl-1 text-success">To</label>
<div class="col-12 col-sm-2">
	<input class="form-control" id="{{$input_to_id}}" type="text" placeholder="Select Date" readonly="">
</div>


<script type="text/javascript">
$('#{{$input_from_id}}').datepicker({
  	format: "dd/mm/yyyy",
  	autoclose: true,
  	todayHighlight: true,
  	changeMonth: true,
    changeYear: true,
    autoSize: true,
  }).datepicker("setDate",getYesterDatDate());;

$('#{{$input_to_id}}').datepicker({
  	format: "dd/mm/yyyy",
  	autoclose: true,
  	todayHighlight: true,
  	defaultDate: new Date(),
  }).datepicker("setDate",new Date());

function getYesterDatDate() {
  var today = new Date();
  var yesterday = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1);
  return yesterday;
}
</script>