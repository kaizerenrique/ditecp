<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    private $mensajeCorreo;
    private $name;
    private $email;
    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $mensajeCorreo, $name, $email, $password)
    {
        $this->subject = $subject;
        $this->mensajeCorreo = $mensajeCorreo;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notificacion', [
            'mensajeCorreo' => $this->mensajeCorreo,
            'name' => $this->name, 
            'email' => $this->email, 
            'password' => $this->password
        ]);
    }
}
