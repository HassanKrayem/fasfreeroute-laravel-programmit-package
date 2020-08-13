<canvas id="{{ $input_id }}_canvas" width="{{ $canvas_width }}" height="{{ $canvas_height }}"></canvas><img id="{{ $input_id }}_image" style="display: none;">
<input id="{{$input_id}}" type="file" class="{{$input_class}}" name="{{ $input_name }}" onchange="createImagePreview(this);">

<script type="text/javascript">
docReady(function()
{	
	setCanvasImage('{{ $base_image }}', _('{{ $input_id }}_canvas'));
})

function createImagePreview(e)
{
  // alert(e.value)
  // alert(e.files[0])
  
  let img = _("{{ $input_id }}_image");
  img.src = URL.createObjectURL(e.files[0]);
  img.onload =  function()
  {
    let c = _('{{ $input_id }}_canvas');
    let ctx = c.getContext("2d");  
    ctx.drawImage(this, 0, 0, img.width, img.height,0, 0, c.width, c.height);
  }
}

function setCanvasImage(image_url, canvas)
{		
	base_image = new Image();
	base_image.src = '/' + image_url;
	base_image.onload = function(){
		c = canvas;
		c.getContext("2d").drawImage(base_image, 0, 0, this.width, this.height,0, 0, c.width, c.height);
	}
	canvasFitToContainer(canvas)
	canvas.setAttribute('height', '100%');
  _('{{$input_id}}').value = "";
}

function canvasFitToContainer(canvas){
  // Make it visually fill the positioned parent
  canvas.style.width ='75%';
  canvas.style.height='100%';
  // ...then set the internal size to match
  canvas.width  = canvas.offsetWidth;
  canvas.height = canvas.offsetHeight;
}
</script>