<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $postarray;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($postarray)
    {
        $this->postarray = $postarray;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registeredcount')
                            ->from('no-reply@nef1.org', "NEF WOW")
                            ->Subject('NEF WOW Daily Digest');
    }
}
