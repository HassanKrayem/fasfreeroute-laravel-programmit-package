<input type="text" list="@yield('laravel_database_search_list', '')" class="form-control p-1 pl-2" id="{{$btn_label}}laravel_entity_db_search_tools_start" placeholder="{{$comp_search_query}}" value="" autofocus>

<script type="text/javascript">
	input = document.getElementById("{{$btn_label}}laravel_entity_db_search_tools_start");
    input.addEventListener("keyup", function(e) {
      e.preventDefault();
      if (e.keyCode === 13) {
        componentRefresh('{{$view_controller}}.partial_list', {
         'comp_search_query': e.target.value.toString()
        });
      }
    },false);
</script>