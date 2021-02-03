<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//         $to_name = 'Imtiaz';
// $to_email = 'shahzaibiftikhar78@gmail.com';
// $data = array('name'=>"Ogbonna Vitalis(sender_name)", "body" => "A test mail");
// Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
// $message->to($to_email, $to_name)
// ->subject('Laravel Test Mail');
// $message->from('shahzaib@obuy.pk','Test Mail');
// });
        return $this->view('mail',['name'=>'Shahzaib'])->to('shahzaib@obuy.pk')->from('shahzaib@obuy.pk');
    }
}
