<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewFeedback extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nombrecliente;
    public $emailcliente;
    public $txtmensaje;

    public function __construct($req)
    {
        //
        
        $this->nombrecliente = $req->nombrecliente;
        $this->emailcliente = $req->emailcliente;
        $this->txtmensaje = $req->txtmensaje;
        
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new-feedback')->subject('Un cliente ha realizado un Comentario');
    }
}
