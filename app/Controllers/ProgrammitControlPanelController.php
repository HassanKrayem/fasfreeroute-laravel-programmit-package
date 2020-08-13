<?php

namespace Programmit\Controllers;

use Illuminate\Http\Request;

/**
 *  version: 1.1
 *  date: 2019 - 1 - 4
 *  Author: Hassan Youssef Krayem
 *  email: developer.hassankrayem@gmail.com
 *  description: class for controlling backend CMS components
 */
class ProgrammitControlPanelController extends \App\Http\Controllers\Controller
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
        $this->viewRoot = 'control_panel.';
        
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
        $page = $request->segment(2);
        dd($page);
        if($page == '')
            $page = 'main';

        $this->data['view_content'] = $page;
        // dd($this->viewRoot . $page);
        return view($this->viewRoot . $page, $this->data);
    }

    /**
     * Accessing the main index view for the current platform
     */
    public function main()
    {
        return view($this->viewRoot . 'index', $this->data);
    }
}
