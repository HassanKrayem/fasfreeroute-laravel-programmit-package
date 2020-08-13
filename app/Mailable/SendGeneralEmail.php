<?php

namespace Programmit\Mailable;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendGeneralEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $hashedLink;
    public $emailTo;
    public $data;
    public $viewPath;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailTo, $data, $viewPath)
    {        
        $this->emailTo = $emailTo;        
        $this->data = $data;
        $this->viewPath = $viewPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if( isset($this->data['title']) && !empty($this->data['title']))
            $subject = $this->data['title'];
        else
            $subject = 'Untitled Email';
        
        return $this->subject($subject)->view($this->viewPath);
       /* return $this->view('emails.orders.shipped')
                    ->attach('/path/to/file', [
                        'as' => 'name.pdf',
                        'mime' => 'application/pdf',
                    ]);*/
    }
}
