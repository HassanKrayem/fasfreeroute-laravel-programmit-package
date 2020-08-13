<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Programmit\Controllers\ProgrammitControlPanelController;

// mail
use App\Mail\TestingMail;
use Illuminate\Support\Facades\Mail;

/**
 *  version: 1.2
 *  date: 2019 - 1 - 4
 *  Author: Hassan Youssef Krayem
 *  email: developer.hassankrayem@gmail.com
 *  description: class for controlling components
 */
class ControlPanelController extends ProgrammitControlPanelController
{

    use \ProgrammitTraits\Mail\ConfirmationEmail;
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	parent::__construct();
    }

	/**
     * Accessing the main index view for the current platform
     */
    public function main()
    {
        // dd(Auth::user()->clientProfile->currecntServiceSubscription->servicePackage->internal_view_name);
        // dd(session('auth_user_plan_view_name'));
        // Mail::to('neotion@outlook.com')->send(new TestingMail());
        $user = Auth::user();
        if($user->isRoot())
        {
            $rootProfile = $user->rootProfile;   
            $planName = $rootProfile->currecntServiceSubscription->servicePackage->internal_view_name;
            $this->data['plan_view_name'] = $planName;
            $this->data['sidebar_header_label'] = $rootProfile->title;      

            return view($this->viewRoot . 'index', $this->data);
        }
        else
        {
            $email_verification_status = $user->emailVerificationStatus();
            if($email_verification_status['verified'])
            {
                $this->data['plan_view_name'] = $user->clientProfile->currecntServiceSubscription->servicePackage->internal_view_name; //session('auth_user_plan_view_name');
                $this->data['sidebar_header_label'] = $user->clientProfile->company_name;//session('auth_user_identifier_name');            

                return view($this->viewRoot . 'index', $this->data);
            }
            else
            {
                $this->data['user'] = $user;
                return view($this->viewRoot . 'email_address_verification_required', $this->data);
            }
        }
        
    }
}
