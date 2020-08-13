{{-- $.LoadingOverlaySetup({
    background : "rgba(0, 0, 0, 0.7)",
    size  : "72px",
    image : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle r="70" cx="500" cy="90"/><circle r="60" cx="500" cy="910"/><circle r="50" cx="90" cy="500"/><circle r="40" cx="910" cy="500"/><circle r="0" cx="212" cy="212"/><circle r="80" cx="788" cy="212"/><circle r="80" cx="212" cy="788"/><circle r="80" cx="788" cy="788"/></svg>',
    image: 'assets/img/apple-icon.png',
    imageColor : "#33ffaf",
    imageAnimation : "1500ms"
}); --}}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function() {
     {{-- $.LoadingOverlay("show"); --}}
     showLoadingSpinner();
  },
  complete: function(){
     {{-- $.LoadingOverlay("hide"); --}}
     hideLoadingSpinner();
  },
});
