<?php

namespace Programmit\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 *  version: 1.2
 *  date: 2019 - 1 - 4
 *  Author: Hassan Youssef Krayem
 *  email: developer.hassankrayem@gmail.com
 *  description: class for controlling components
 */
class ProgrammitPublicPlatformController extends \App\Http\Controllers\Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->legos_css = '';
        $this->legos_js = '';
        $this->viewRoot = 'public_platform.';
        
        $this->data = [
            'legos_js' => $this->legos_js,
            'legos_css' => $this->legos_css,
            'viewRoot' => $this->viewRoot
        ];
    }


    /**
     * Common Prerequiset for all components
     * @param  text  $main_page                 name of index page to look for
     * @param  Request $request                 Request Object
     * @param  Associative Array                &$componentDataPackage
     * @return null                             null
     */
    public function componentBoot($main_page, Request $request, &$componentDataPackage)
    {
        
    }

    /**
     * Reading Views from route using the second argument / segment
     */
    public function view(Request $request)
    {
        $lang = $request->segment(1);
        $page = $request->segment(2);
        if($page == '')
            $page = 'home';

        $this->data['view_content'] = $page;
        $this->data['app_lang'] = $lang;
        
        // dd($this->viewRoot . $page);
        return view($this->viewRoot . $page, $this->data);
    }

   /**
     * Accessing the main index view for the current platform
     */
    public function main()
    {

        if(Auth::check())
        {

            /*$redirct = session('auth_user_login_path');
            if(empty($redirct))
            {
                Auth::logout();
                return redirect('/');
                //return 'Error login.100';
            }

            return redirect($redirct);*/
            return view($this->viewRoot . 'index', $this->data);
        }
        else
        {
            return view($this->viewRoot . 'index', $this->data);
        }
        
    }

}
