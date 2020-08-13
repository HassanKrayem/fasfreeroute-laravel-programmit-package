<?php

namespace Programmit\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgrammitEmailVerificationController extends \App\Http\Controllers\Controller
{
    use \ProgrammitTraits\Mail\ConfirmationEmail;
    
    public function __construct()
    {

    }

    public function email_verification($token)
    {
        $token = \ProgrammitModel\EmailVerificationToken::where('token', $token)->first();
        if($token)
        {
            // 
            $token->delete();
            $user = \App\User::where('email',$token->email)->first();
            $user->verified_email = true;
            $user->save();

            session()->flash('xxx_permisson_access_email_confirmation_page', "access");
            session()->flash('xxx_permisson_access_email_confirmation_page_user', $user->id);    
        }
        
        return redirect('p/secure/verification/account/confirmed');
    }

    public function confirmed_account_email()
    {
        //return view('programmit_emails.confirmed_account', Auth::user());
        if(session()->has('xxx_permisson_access_email_confirmation_page') )
        {
            $user = \App\User::findOrFail( session()->get('xxx_permisson_access_email_confirmation_page_user') );

            return view('programmit_emails.confirmed_account', Auth::user());
        }
        else
        {
            return redirect('/');
        }
    }

    public function set_valid_email($email)
    {

    }
}
