{{-- tab_view_tab_id  and search_query should be defined in the component / partial view--}}

{{-- // Pagination Links from Laravel --}}
collectionLoopOn(document.getElementById('{{$comp_container_id}}').getElementsByClassName("page-link"),
function(ele, param)
{
  {{-- //Skipping Datatable pagination Links --}}
  if(ele.getAttribute('href') != "#" && ele.getAttribute('href'))
  {
    ele.onclick = function() {
        loadLinkPage(ele.getAttribute('data-link'), '', "#{{$comp_container_id}}");
    }
    ele.setAttribute('data-link', ele.getAttribute('href')  + "&search=" + encodeURIComponent("{{ $comp_search_query }}") );
    ele.setAttribute('href', '#');
  }
},{});