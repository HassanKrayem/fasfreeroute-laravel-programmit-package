<style type="text/css">
  #{{$comp_table_id}}_filter
  {
    display: none;
  }
  .dataTable tr th
  {
    font-size: 9pt;
    font-weight: 500;
    background-color: #009688;
    vertical-align: middle;
    text-align: center;
    color: #fff;    
  }

  .dataTable tr td
  {
    vertical-align: middle;
  }
</style>
<div id="{{$comp_container_id}}">
  {{-- Pagination and data search --}}
  @include($comp_role_legos . 'row_datatable_field_pagination_and_data_search')
  
  {{-- Advanced Features --}}
  @if(isset($cf_search_date_fields))
  @include($comp_role_legos . 'row_datatable_field_advanced_search')
  @endif
  
  <div class="row mb-4"></div>  
  
  @yield('table')

  @include($comp_role_legos .  'laravel_paginate_links_bottom', [ 'entities' => $table_records])
</div> {{-- End Container --}}

<script type="text/javascript">
  table = $('#{{$comp_table_id}}').DataTable({
    paging      : @yield('datatable_paging', 'false'),
    lengthChange: @yield('datatable_length_change', 'false'),
    searching   : @yield('datatable_searching', 'true'),
    ordering    : @yield('datatable_ordering', 'false'),
    info        : @yield('datatable_info', 'true'),
    responsive  : @yield('datatable_responsive', 'true'),
    autoWidth   : @yield('datatable_autoWidth', 'false'),
    oLanguage: {
    "sSearch": "Search Table"
    }
  });
  
  $('#{{$btn_label}}_datatable_search').on( 'keyup', function () {
      table.search(this.value).draw(true);
  } );
  

  collectionAssignAction(document.getElementsByClassName('comp_entity_delete_action'),
  function(ele, param)
  {
      entityDeleteFunction({
          ele: ele,
          deleteRoute: "{{$comp_request_route}}delete",
          deleteRouteMethod: "{{$comp_delete_route_method}}",
      })
  },
  {});

@if(!isset($no_paginate))
  @include($comp_role_legos . 'laravel_paginate_links_to_component')
@endif
  
@include($comp_role_legos . 'comp_edit_input_fields')
  
   {{-- --ollectionAssignAction(document.getElementById('{{$comp_container_id}}').getElementsByClassName('ac_view_edit_board'),
  function(ele, param)
  {
      recordRow = ele.closest('tr');
      lkey = recordRow.getAttribute('data-lkey');
      lequeneFetchModalData('cpanel/component/platform.board.edit/' + lkey, 'View / Edit {{$componentName}}')
  },
  {});--}}
</script>