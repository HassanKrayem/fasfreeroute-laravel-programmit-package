{{-- 
    @Author: Hassan Krayem
    @Email: developer.hassankrayem@gmail.com
    @script version: 1.4
    @Last update: 2018/11/13
 --}}

var ULOG_DEBUGGING = true;

function ulog()
{    
    if(ULOG_DEBUGGING)
    {
        let alength = arguments.length;
        for (let i = 0; i < alength; i++) {
            console.log(arguments[i]);
        }
    }
}

function evalJSFromHtml(html)
{
    
    var newElement = document.createElement('div');
    newElement.innerHTML = html;

    var scripts = newElement.getElementsByTagName("script");
    for(var i = 0; i < scripts.length; ++i) {
        
        var script = scripts[i];
        eval(script.innerHTML); 
        
    }
    
}

function collectionLoopOn(collec, func, funcParam)
{
    for( let e = 0; e < collec.length; e++)
    {      
        func(collec[e], funcParam)
    }
}

function collectionAssignAction(collec, func, funcParam)
{
    for( let e = 0; e < collec.length; e++)
    {      
      collec[e].onclick = function()
      {        
        func(collec[e], funcParam)
      }
    }
}

function gebc(cls, ele)
{
    if (!ele) {
        ele = document;
    }

    return ele.getElementsByClassName(cls);
}

function entityUpdateFunction(param)
{
    // must has: param.compBtnId, param.storeRouteMethod, param.storeRoute, param.requestData.
    let btn = document.getElementById(param.compBtnId);
    btn.onclick = function() {
        axiosReady(param.updateRouteMethod, param.updateRoute, new FormData(document.getElementById(param.formId)),
        function(data) {

            if(typeof param.onSuccess == 'function')
            {
                param.onSuccess(param.onSuccessParam);
            }

            swal({
                position: 'top-end',
                type: 'success',
                title: param.swalSuccessTitle || 'Updated Successfully',
                showConfirmButton: false,
                timer: 2500,
                toast: true,
            })
            
        },
        function(data, errors) {
            swal({
                type: 'warning',
                title: param.swalFailedTitle || 'Please Check the Following warnings',
                html: axiosBuildErrorReport(errors),
            })
        
            }
        );
    }   
}

function entityCreateFunction(param)
{
    // must has: param.compBtnId, param.storeRouteMethod, param.storeRoute, param.requestData.
    let btn = document.getElementById(param.compBtnId);
    btn.onclick = function() {
        axiosReady(param.storeRouteMethod, param.storeRoute, new FormData(document.getElementById(param.formId)),
        function(data) {

            successMessage = function(){
                swal({
                    position: 'top-end',
                    type: 'success',
                    title: param.swalSuccessTitle || 'Created Successfully',
                    showConfirmButton: false,
                    timer: 2500,
                    toast: true,
                })
            }

            if(typeof param.onSuccess == 'function')
            {
                param.onSuccess(data, successMessage,param.onSuccessParam);
            }            
            
        },
        function(data, errors) {
            swal({
                type: 'warning',
                title: param.swalFailedTitle || 'Please Check the Following warnings',
                html: axiosBuildErrorReport(errors),
            })
        
            }
        );
    }
}


function entityDeleteFunction(param)
{
    // must has: param.ele, param.deleteRoute, param.deleteRouteMethod
    swal({
    title: param.swalQuesTitle || 'Are you sure?',
    text: param.swalQuesText || "You won't be able to revert this!",
    type: param.swalQuesType || 'warning',
    showCancelButton: true,
    confirmButtonText: param.swalQuesConfirmBtnText || 'Yes, delete it!',
    cancelButtonText: param.swalQuesCancleBtnText || 'No, cancel!',
    reverseButtons: false
    }).then((result) => {
    if (result.value) {

        recordRow = param.ele.closest('tr');
        lkey = recordRow.getAttribute('data-lkey');

        if(typeof param.onConfirm == 'function')
        {
            param.onConfirm(lkey);
        }

        if(typeof param.requestData != 'object')
        {
            param.requestData = {};
        }
        
        axiosReady( param.deleteRouteMethod || 'post', param.deleteRoute + '?l=' + lkey, param.requestData,
        function(data) {

            successMessage = function(){
                swal({
                    title: param.swalSuccessTitle || 'Success',
                    text: param.swalSuccessText || "Removing Completed",
                    type: 'success',
                })
            }
            
    
            recordRow.style.display = 'none';

            if(typeof param.onSuccess == 'function')
            {
                param.onSuccess(data, successMessage, lkey, recordRow);
            }
    
        },
        function(data, errors) {
        swal({
            type: param.swalFailedType || 'error',
            title: param.swalFailedTitle || 'Please Check the Following error(s)',
            html: param.swalFailedHtml || axiosBuildErrorReport(errors),
        })
    
        });

    } else if (result.dismiss === swal.DismissReason.cancel) {

        {{-- swal({
        title: 'Cancelled',
        text: "Division is safe",
        type: 'info',
        showCancelButton: false,
        confirmButtonText: 'Ok',
        }) --}}

        }
    })
}

function fullWindowFetchModalData(param)
{
    if(document.getElementById('fullWindowFetchModalData_id'))
    {
        swal({
            type: param.errorMessageType || 'warning',
            title: param.errorMessageTitle || 'CDR Already Open',
            html: param.errorMessageText || 'Please close the current CDR',
            toast: false,
            position: param.errorMessagePosition || 'center',
            showConfirmButton: true,
          });
        return;
    }

    axios.get(param.url).then(response => {
        
        let fullWindow = document.createElement('div');
        fullWindow.setAttribute('id', 'fullWindowFetchModalData_id')

        let defaultCssStyleText = "width:100%;height:100%;padding:15px;margin:0px;background:#fff;font-size:9pt;position:fixed;left:0px;top:0px;z-index:1000;overflow:auto"
        fullWindow.style.cssText = param.cssText || defaultCssStyleText;
        
        let closebutton = document.createElement('button');
        closebutton.setAttribute('class', 'btn btn-danger float-right');
        closebutton.innerText = "x";
        closebutton.onclick = function()
        {
            if(typeof param.onCloseFunction == 'function')
            {                
                param.onCloseFunction( param.onCloseFunctionParam, this);
            }
            else
            {
                this.parentNode.parentNode.removeChild(this.parentNode);
            }
        }


        let fullWindowBody = document.createElement('div');
        fullWindowBody.innerHTML =  response.data;
        
        fullWindow.appendChild(closebutton);
        fullWindow.appendChild(fullWindowBody);
        document.body.appendChild(fullWindow);

        evalJSFromHtml(response.data);

    });

}

{{-- Requires pi_loading_spinner_css.blade.php --}}
function showLoadingSpinner()
{
    let container = document.createElement('div');
    container.setAttribute('id', 'pi_loading_spinner_container')
    let defaultCssStyleText = "width:100%;height:100%;margin:0px;background-color:rgba(45,45,45, .6);font-size:9pt;position:fixed;left:0px;top:0px;z-index:1000;overflow:hidden";
    container.style.cssText = defaultCssStyleText;


    let loadingSpinner = document.createElement('div');    
    loadingSpinner.setAttribute('id', 'pi_loading_spinner')
    loadingSpinner.setAttribute('class', 'pi_loading_spinner');

    container.appendChild(loadingSpinner);    
    document.body.appendChild(container);
}

function hideLoadingSpinner()
{
    let lsc = document.getElementById('pi_loading_spinner_container');
    lsc.parentNode.removeChild(lsc);
}

function _(id)
{
    return document.getElementById(id);
}

function isIndatalist(val, dl)
{
    let a = document.getElementById(dl);
    let o = a.options;
    let l = o.length;
    
    for (let i = 0; i < l ; i++) {
      if(val == o[i].value)
        return true;
    } 
    return false;
}

function getSelectTagText(selectTag)
{
    return selectTag.options[selectTag.selectedIndex].text;
}

// getting element
function _(i)
{
    return document.getElementById(i);
}

// creating element
function __(t)
{
    return document.createElement(t);
}

// setting element attributes
function ea(e, a)
{
    for(x in a)
        e.setAttribute(x, a[x])

    return e;
}

(function(funcName, baseObj) {
    // The public function name defaults to window.docReady
    // but you can pass in your own object and own function name and those will be used
    // if you want to put them in a different namespace
    funcName = funcName || "docReady";
    baseObj = baseObj || window;
    var readyList = [];
    var readyFired = false;
    var readyEventHandlersInstalled = false;

    // call this when the document is ready
    // this function protects itself against being called more than once
    function ready() {
        if (!readyFired) {
            // this must be set to true before we start calling callbacks
            readyFired = true;
            for (var i = 0; i < readyList.length; i++) {
                // if a callback here happens to add new ready handlers,
                // the docReady() function will see that it already fired
                // and will schedule the callback to run right after
                // this event loop finishes so all handlers will still execute
                // in order and no new ones will be added to the readyList
                // while we are processing the list
                readyList[i].fn.call(window, readyList[i].ctx);
            }
            // allow any closures held by these functions to free
            readyList = [];
        }
    }

    function readyStateChange() {
        if ( document.readyState === "complete" ) {
            ready();
        }
    }

    // This is the one public interface
    // docReady(fn, context);
    // the context argument is optional - if present, it will be passed
    // as an argument to the callback
    baseObj[funcName] = function(callback, context) {
        if (typeof callback !== "function") {
            throw new TypeError("callback for docReady(fn) must be a function");
        }
        // if ready has already fired, then just schedule the callback
        // to fire asynchronously, but right away
        if (readyFired) {
            setTimeout(function() {callback(context);}, 1);
            return;
        } else {
            // add the function and context to the list
            readyList.push({fn: callback, ctx: context});
        }
        // if document already ready to go, schedule the ready function to run
        if (document.readyState === "complete") {
            setTimeout(ready, 1);
        } else if (!readyEventHandlersInstalled) {
            // otherwise if we don't have event handlers installed, install them
            if (document.addEventListener) {
                // first choice is DOMContentLoaded event
                document.addEventListener("DOMContentLoaded", ready, false);
                // backup is window load event
                window.addEventListener("load", ready, false);
            } else {
                // must be IE
                document.attachEvent("onreadystatechange", readyStateChange);
                window.attachEvent("onload", ready);
            }
            readyEventHandlersInstalled = true;
        }
    }
})("docReady", window);
{{-- console.log('Hello from Laravel Hassan Legos Util file.') --}}