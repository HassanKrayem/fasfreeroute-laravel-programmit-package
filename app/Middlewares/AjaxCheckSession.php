<?php

namespace Programmit\Middlewares;

use Illuminate\Support\Facades\Auth;
use Closure;

class AjaxCheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->isXmlHttpRequest())
        {
            if( !Auth::check())
            {
                if($request->ajax())
                {
                    return response()->json([
                    'errors' => ['unauthorized'],
                    ]
                    , 401);
                    //throw new AuthenticationException('Unauthenticated');
                }
            }
            else if( !empty(session('auth_required_payment')) )
            {
                return response()->json([
                    'errors' => ['Required Payment'],
                    ]
                , 402);
            }

        }
        
        // following deffirent approcahe - using componentValidAction Method
        /*else if( !empty(session('auth_method_not_allowed')) )
        {
            return response()->json([
                'errors' => ['Method Not Allowed'],
                ]
                , 405);
        }*/


        return $next($request);    
    }
}
