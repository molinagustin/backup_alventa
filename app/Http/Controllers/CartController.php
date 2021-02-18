<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function update()
    {
        //Obtenemos el carrito activo de un usuario a traves del campo calculado ACCESOR nombre getCartAttribute
        $cart = auth()->user()->cart;
        $cart->status_id = 2;//Se le cambia el estado a pendiente (2)
        //Se realiza un UPDATE
        $cart->save();

        //Por medio de una variable de sesion flash enviamos una notificacion
        $notification = 'Tu pedido se ha realizado correctamente. Te contactaremos pronto vía email.';
        return back()->with(compact('notification'));
    }
}
