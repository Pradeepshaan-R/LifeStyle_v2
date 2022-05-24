<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
/**
 * From the controller do this:
 * $to = 'azmeer.sc@gmail.com';
 *      $details = [
 *          'subject' => 'This is the subject.',
 *          'body' => 'This is the email body.'
 *      ];
 * Mail::to($to)->send(new WelcomeMail($details));
 */
class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.welcomeMail')
            ->subject($this->details['subject'])
            ->with('body', $this->details);
    }
}
