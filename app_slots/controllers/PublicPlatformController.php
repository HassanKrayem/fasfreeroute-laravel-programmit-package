<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Programmit\Controllers\ProgrammitPublicPlatformController;
/**
 *  version: 1.2
 *  date: 2019 - 1 - 4
 *  Author: Hassan Youssef Krayem
 *  email: developer.hassankrayem@gmail.com
 *  description: class for controlling components
 */

class PublicPlatformController extends ProgrammitPublicPlatformController
{
    public function signup()
    {
        $this->data['services_packages'] = \App\ServicePackage::enabled()->get();
        return view($this->viewRoot . 'signup', $this->data);
    }

    public function details()
    {        
        $this->data['services_packages'] = \App\ServicePackage::enabled()->get();
        return view($this->viewRoot . 'details', $this->data);
    }
}
