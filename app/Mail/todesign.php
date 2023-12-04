<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class todesign extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Solicitud de elaboración No '.$this->data['id'])
                    ->view('email.shop');
        /*$emails = ['email address 1', 'email address 2'];
            $files = ['url 1','url 2'];
            Mail::send('emails.welcome', [], function($message) use ($emails, $files)
            {
                $message->to($emails)->subject('This is test e-mail');
                foreach ($files as $file){
                    $message->attach($file);
                }
        );*/
    }
}
