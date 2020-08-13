collectionLoopOn(document.getElementById('{{$tab_view_tab_id}}').getElementsByClassName("ac-user-email-status"),
function(e, p) {
  e.ondblclick = function(){
      changeUserEmailVerificaitonStatus(this);
  }
}, {});

function changeUserEmailVerificaitonStatus(ele)
{
  swal({
    title: 'Select An Action',
    input: 'select',
    inputOptions: {
        'Yes' : 'Yes',
        'No' : 'No',      
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
          axiosReady('post','component_request/admin_panel.change_user_email_status', { user_id : rowId, status : statusValue },
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