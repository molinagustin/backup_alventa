<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\User;

class EmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;


    //Atributo público para la URL de confirmación
    public $email_confirmation_url;
    public $user;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $email_confirmation_url)
    {
        $this->user = $user;
        $this->email_confirmation_url = $email_confirmation_url;       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.confirmation')
                    ->from('welcome@alventa.com.ar')
                    ->subject('Bienvenido/a');
    }
}
