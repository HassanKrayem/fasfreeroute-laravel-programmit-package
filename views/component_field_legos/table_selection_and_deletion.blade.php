<div class="row">
  <div class="col-12 col-sm-3 pt-2">
      <a href="javascript:void(0);" class="text-success ac_select_toggle_{{$comp_orginal_id}}" data-state="0"><i class="fa fa-list"></i> Select Toggle</a>
  </div>
  <div class="col-12 col-sm-3 pt-2">
      <a href="javascript:void(0);" class="text-success ac_delete_selected_{{$comp_orginal_id}}"><i class="fa fa-close"></i> Delete Selected {{$compTitleP}}</a>
  </div>
</div>

<script type="text/javascript">
collectionLoopOn(document.getElementById('{{$comp_container_id}}').getElementsByClassName("ac_delete_comp_model"),
function(ele, param)
{
  ele.onclick = function(){

    entityDeleteFunction({
          ele: ele,
          deleteRoute: "{{$comp_request_route}}delete",
          deleteRouteMethod: "{{$comp_delete_route_method}}",
      })

  }    
},{});


collectionLoopOn(document.getElementById('{{$comp_container_id}}').getElementsByClassName("ac_delete_selected_{{$comp_orginal_id}}"),
function(ele, param)
{
  ele.onclick = function(){
    checkedBoxes = [];

    inputCheckBoxes = document.querySelectorAll('input[name=comp_model_selection]:checked');
    for( let i = 0; i < inputCheckBoxes.length; i++)
    {
      val = inputCheckBoxes[i].value; 
      checkedBoxes.push(val);
    }

    if(checkedBoxes.length == 0)
    {
      swal({
        type: 'warning',
        title: 'No {{$compTitleS}} Is Selected',
      });
      return;
    }

    swal({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    reverseButtons: false
      }).then((result) => {
        if (result.value) {

            axiosReady('post','{{$comp_request_route}}delete', { comp_model_selection : checkedBoxes },
              function(response) {

                for( let i = 0; i < inputCheckBoxes.length; i++)
                {
                  tr = inputCheckBoxes[i].closest('tr');
                  tr.parentNode.removeChild(tr);
                }

                    swal({
                    type: 'success',
                    title: 'Successfull',
                    text: '{{$compTitleP}} Deleted',
                  });

                },
                function(data, errors) {
                    swal({
                        type: 'error',
                        title: 'Please Check the Following error(s)',
                        html: axiosBuildErrorReport(errors),
                    })
                  }
              );

        } else if (result.dismiss === swal.DismissReason.cancel) {

          swal({
            title: 'Cancelled',
            text: "{{$compTitleP}} are safe",
            type: 'info',
            showCancelButton: false,
            confirmButtonText: 'Ok',
          })

        }
      })
  }
},{});


collectionLoopOn(document.getElementById('{{$comp_container_id}}').getElementsByClassName("ac_select_toggle_{{$comp_orginal_id}}"),
function(ele, param)
{
  ele.onclick = function(){
    $state = null;
    if(this.getAttribute('data-state') == 0) {
      this.setAttribute('data-state', 1);
      $state = true;
    }
    else
    {
      this.setAttribute('data-state', 0);
      $state = false;
    }

    collectionLoopOn(document.getElementById('{{$comp_container_id}}').getElementsByClassName("comp_model_selection"),
    function(ele, param)
    {
      ele.checked = $state;
    },{});
  }
},{});
</script>