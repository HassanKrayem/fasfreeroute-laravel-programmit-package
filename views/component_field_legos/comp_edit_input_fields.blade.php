collectionLoopOn(document.getElementsByClassName("comp-editable-field"),
function(ele, param)
{

  ele.ondblclick = function(){
    if( this.getAttribute('readonly') )
    {
        this.removeAttribute('readonly');
        this.blur();
        this.focus();
        {{-- list = this.getAttribute('list');
        this.setAttribute('list', '');
        this.setAttribute('list', list); --}}

    }
    else
    {
      

      l = ele.closest('tr');
      l = l.getAttribute('data-lkey');
      f = this.getAttribute('data-f');
      u = this.value.toString();

      this.setAttribute('readonly', '1');
      axiosReady('post','component_request/{{$view_controller}}.update_'+f, { l : l, f : f, value : u },
      function(r) {
        r = r.data;
        if(r == 1)
        {
          swal({
            type: 'success',
            title: 'Successfull',
            text: 'Field Updated',
            toast: true,
            position : 'top',
            timer: 1000,
          });
        }
      }, null);

    }
    
  }
},{});