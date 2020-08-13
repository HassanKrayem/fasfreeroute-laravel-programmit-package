<div class="row">
  {{-- Laravel Pagination --}}
  <div class="col-12 col-sm-9">
    @include($comp_role_legos .  'laravel_paginate_links_top', [ 'entities' => $table_records])
  </div>

  {{-- Datatable Search --}}
   <div class="col-12 col-sm-3">
    <div class="form-group row m-0">
     <label class="col-12 col-sm-5 col-form-label pl-1 text-success">@yield('datatable_search_text', 'Search Table')</label>
      <div class="col-12 col-sm-7">
        <input type="text" class="form-control p-1 pl-2" id="{{$btn_label}}_datatable_search" value="">
      </div>
    </div>
  </div>

  {{-- Laravel Database Search --}}
  {{-- <div class="col-12 col-sm-3">
    <div class="form-group row m-0">
     <label class="col-12 col-sm-4 col-form-label pl-1 text-info">@yield('laravel_database_search_text', 'Search DB')</label>
      <div class="col-12 col-sm-8 mb-3">
        @include($comp_role_legos . 'laravel_entity_db_search_tools')
      </div>
    </div>
  </div> --}}
</div>