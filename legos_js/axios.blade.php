axiosCreate = axios.create();
axiosCreate.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Add a request interceptor
axiosCreate.interceptors.request.use(function (config) {
    showLoadingSpinner();
    return config;
  }, function (error) {
    // Do something with request error
    return Promise.reject(error);
  });

// Add a response interceptor
axiosCreate.interceptors.response.use(function (response) {
    hideLoadingSpinner();
    return response;
  }, function (error) {
    {{-- console.log('axios_error');
    console.log(error); --}}
    hideLoadingSpinner();
    // Do something with response error
    return Promise.reject(error);
  });

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axiosCreate.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

function axiosReady(method, url, data, succFunc, errorFunc) {
  axiosCreate({
    method: method,
    url: url,
    data: data,
    config: { headers: {'Content-Type': 'multipart/form-data' }},
    })
    .then(function (response) {
      if(typeof succFunc == 'function')
        succFunc(response);
      
    })
    .catch(function (error) {
      if(typeof errorFunc == 'function'){
        errorFunc(error.response.data, error.response.data.errors)
      }
      else
      {
        Swal.fire(
          'Check the following Errors',
          axiosBuildErrorReport(error.response.data.errors),
          'error'
        );
      }
    });


    {{--  axios.post(url, data).then(response => {
      
      succFunc(response);

    }).catch(error => {

      errorFunc(error.response.data, error.response.data.errors)
      
    });  --}}

}

function axiosBuildErrorReport(errors)
{
  let r = '<ul style="text-align:left;padding-top:12px;">';
  for(error in errors)
  {
    r += '<li> - ' + errors[error] + '</li>';
  }
  return r + '</ul>';
}