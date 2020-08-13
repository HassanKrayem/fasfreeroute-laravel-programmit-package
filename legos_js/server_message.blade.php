@if(session()->has('server_message'))
    $(function() {
        // setTimeout() function will be fired after page is loaded
        // it will wait for 5 sec. and then will fire
        // $("#successMessage").hide() function
        setTimeout(function() {
            $("#server_message").slideUp(1000);
        }, 3000);
    });
@endif