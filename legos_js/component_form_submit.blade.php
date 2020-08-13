{{$comp_form_btn_id}} = document.getElementById('{{$comp_form_btn_id}}');
    {{$comp_form_btn_id}}.onclick = function() {
        axiosReady('{{$comp_form_current_method}}','{{$comp_form_store_route}}', new FormData(document.getElementById('{{$comp_form_id}}')),
            {!!$successFunc!!},
            {!!$failerFunc!!}
        );
    }