<?php

namespace Programmit\Traits\Mail;

use \Illuminate\Support\Facades\Mail;

trait ConfirmationEmail
 {
 	
 	public function ConfirmationEmail($user, $data = [], $viewPath = 'programmit_emails.account_verificaiton_email')
 	{
 		$token = substr(hash('sha256',MD5(rand())),1,25);

		 $ConfirmationEmail = \ProgrammitModel\EmailVerificationToken::updateOrCreate
		 (
			['email' => $user->email],
			['token' => $token]
		);

        // $ConfirmationEmail->email = $user->email;
        // $ConfirmationEmail->token = $token;
		$ConfirmationEmail->save();

		$data['company_profile'] = \ProgrammitModel\OwnerProfile::where('id', 1)->first();

        Mail::to($user->email)->send(new \ProgrammitMailable\account_verification_email($user, $token, $data, $viewPath));
        if (Mail::failures()) {
        	return false;
    	} 

    	return true;
 	}

 }