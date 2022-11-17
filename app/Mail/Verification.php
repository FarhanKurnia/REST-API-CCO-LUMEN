<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Verification extends Mailable
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
        return $this->from('sender@gmail.com')
                    ->markdown('email-verification')
                    ->subject('Verification Account')
                    ->with('data', $this->data);
                    // ->attach(public_path('/img/a.png'), [
                    //     'as'    => 'a.png',
                    //     'mime'  => 'image/png',
                    // ]);
    }
}
