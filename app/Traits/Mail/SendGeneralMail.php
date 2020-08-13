<?php

namespace Programmit\Traits\Mail;

use \Illuminate\Support\Facades\Mail;

trait SendGeneralEmail
 {
    
    public function sendGeneralEmail($toEmail, $data = [], $viewPath = 'programmit_emails.general_email_template')
    {
        Mail::to($toEmail)->send(new \Programmit\Mailable\SendGeneralEmail($toEmail, $data, $viewPath));
        if (Mail::failures()) {
            return false;
        }

        return true;
    }

 }