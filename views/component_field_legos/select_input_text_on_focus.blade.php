inputs = _('{{$comp_form_id}}').querySelectorAll("input[type=text]");
inputsl = inputs.length;    
for( i = 0; i < inputsl; i++)
{
    inputs[i].onfocus = function(e){e.target.setSelectionRange(0, e.target.value.length);};
}