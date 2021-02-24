<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Cart;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    //Se crean 2 atributos publicos que seran necesarios en el mail.
    public $user;
    public $cart;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Cart $cart)
    {
        //En los atributos publicos creados anteriormente, guardamos los datos del usuario y el carrito de compras pasado por parametros y casteados
        $this->user = $user;
        $this->cart = $cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new-order')
                    ->subject('Nuevo Pedido!');//Por medio del metodo Subject, le aclaramos el titulo/asunto del correo, sino de otra forma figuraria el nombre de la clase (NewOrder)
    }
}
