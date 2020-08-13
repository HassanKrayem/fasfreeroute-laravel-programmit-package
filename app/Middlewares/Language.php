<?php 

namespace Programmit\Middlewares;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
// use Illuminate\Contracts\Routing\Middleware;

class Language
{

    public function __construct(Application $app, Redirector $redirector, Request $request) {
        $this->app = $app;
        $this->redirector = $redirector;
        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->isXmlHttpRequest()){
            return $next($request);
        }
        
        // Make sure current locale exists.
        $locale = $request->segment(1);
        
        // accessing objects takes more time from static data, so new approach will be used  
        //if ( ! array_key_exists($locale, $this->app->config->get('app.locales'))) {
        if ( !in_array($locale, $this->app->config->get('app.locales')) && !in_array($locale, $this->app->config->get('app.no_lang_routes'))) {
            $segments = $request->segments();
            
            $route = $this->app->config->get('app.fallback_locale') . '/' . implode('/', $segments);

            $queryString = $request->getQueryString();
            if(!empty($queryString))
                $queryString = '?' . $queryString;

            return $this->redirector->to($route . $queryString);
        }
 
        $this->app->setLocale($locale);
        //dd('valid lang segment:' . $this->app->getLocale());

        return $next($request);
    }

}