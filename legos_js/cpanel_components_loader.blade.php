/**
    @Author: Hassan Krayem
    @Email: Developer.hassankrayem@gmail.com
    @Date: 11/12/2018
    @version: 2.1.3
    @description: javascript functions to load
    views without page refreshing
*/

{{-- /**
* The Selected Element should has the following data attributes:
* data-link
* data-header-title
* data-target-container
* data-link holds the url, which the last portion of it would be 
* treated as following:
* controlName_componentName_properties
* e.g
* cpanel/root/components/platform_boards_a3
* platform => PlatFormController
* boards => PlatFormController@boards
* Route::get('cpanel/root/a3', 'PlatFormController@boards')
*/ --}}
function setDataLinksEvent(cls)
{
    $(cls).each(function() {
        $(this).off("click").click(function() { loadLinkPage($(this).data('link'), $(this).data("header-title"),  $(this).data("target-container") || "#app-content"); });
    });
}

function componentRefresh(compId, data)
{
  let c = _(compId);
  if(!c)
  {
    swal({
      type: 'warning',
      title: 'Error - No View for Refreshing UI',
      html: "",
    })  
    return;
  }

  if(!data){
    data = '';
  }
  
  loadLinkPage('/component/' + compId + '?' + encodeQueryData(data), c.getAttribute('data-header-title'), c);
}

function loadLinkPage(link,pageHeaderTitle, ele)
{  
    if(!pageHeaderTitle)
        pageHeaderTitle = "";
    
    //link = link.split("-");
    $query = '';
    if(link.indexOf('?') == -1)
    {
        $query = '?';
    }
    
    $(ele).load(link + $query + "&headerTitle=" + encodeURIComponent(pageHeaderTitle),  function(responseTxt, statusTxt, xhr){

        var lang = "{{Config::get('app.locale')}}";
        var ar = "عذرا، يرجى المحاولة مرة أخرى في وقت لاحق";
        var en = "Sorry, please try again later.";
                  
        if (xhr.status == 401) {
            swal({
              {{-- position: 'top-end', --}}
              type: 'info',
              title: 'Session Expired',
              text: 'You Will be Redirected to login',
              showConfirmButton: false,
              timer: 2000
            }).then((result) => {
              if (result.dismiss === swal.DismissReason.timer) {
                window.location = '/login';
              }
            })
        }
        else if (xhr.status == 402)
        {
            swal({
              {{-- position: 'top-end', --}}
              type: 'warning',
              title: 'Payment is Required',
              text: 'You Will be Redirected to Payment Page',
              showConfirmButton: false,
              timer: 4000
            }).then((result) => {
              if (result.dismiss === swal.DismissReason.timer) {
                window.location = '/payment/pay/current/subscription';
              }
            })
        } else if (xhr.status == 405) {
            swal({
              {{-- position: 'top-end', --}}
              type: 'warning',
              title: 'Attention',
              html: axiosBuildErrorReport(JSON.parse(responseTxt).errors),
              showConfirmButton: false,
            });
        } else if (xhr.status == 404) {
            swal({
              {{-- position: 'top-end', --}}
              type: 'warning',
              title: 'Attention',
              html: axiosBuildErrorReport(JSON.parse(responseTxt).errors),
              showConfirmButton: false,                  
            });
        } else if (statusTxt == "error") {
            swal({
                title: '',
                text: (lang == "ar")? ar : en,
                type: 'warning',
                toast: true,
                })
            {{-- console.log(responseTxt); --}}
        } else {
            
            $("html,body").animate({ scrollTop: 0 }, "fast");
            {{-- document.getElementById('app-content').innerHTML = responseTxt; --}}
            //modalLoader.evalJSFromHtml(document.getElementById("contentView").innerHTML);
        }
        
    });
    
}

function encodeQueryData(data) {
   const ret = [];
   for (let d in data)
     ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
   return ret.join('&');
}

setDataLinksEvent('[data-link]');