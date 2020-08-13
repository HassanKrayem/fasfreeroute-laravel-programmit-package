collectionLoopOn(document.getElementById('{{$tab_view_tab_id}}').getElementsByClassName("ac-user-status-change"),
function(e, p) {
  e.ondblclick = function(){
      changeUserAccountStatus(this);
  }
}, {});

function changeUserAccountStatus(ele)
{
  swal({
    title: 'Select An Action',
    input: 'select',
    inputOptions: {
      @foreach($userAccountStatuses as $ig)
        '{{$ig->label}}' : '{{$ig->label}}',
      @endforeach
    },
    inputPlaceholder: '',
    showCancelButton: true,
    inputValidator: (statusValue) => {
      return new Promise((resolve) => {

        if (statusValue === '')
        {            
          resolve('You need to select an Action')
        }
        else
        {

          recordRow = ele.closest('tr');
          rowId = recordRow.getAttribute('data-lkey');
          axiosReady('post','component_request/admin_panel.change_user_account_status', { user_id : rowId, status : statusValue },
          function(response) {
            d = response.data;
            if(d == 1)
            {
                ele.value = statusValue;
                m = {type: 'success', title: 'Successfull', text: 'Status Changed'};
            }
            else
            {
              m = {type: 'warning', title: 'Attention', text: "Status isn't Changed"};
            }
            swal(m);
          }, null);

            resolve();
        }

      })
    }
  }) {{--  End swal  --}}
}