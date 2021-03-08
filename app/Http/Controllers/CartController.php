<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Mail\OrderRequested;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Cart;
use Mail;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Cart $cart)
    {
        if($cart->user->id == auth()->user()->id)
            return view('orders.show')->with(compact('cart'));
        return redirect(route('dashboard'));
    }

    public function update()
    {
        //Obtenemos el carrito activo de un usuario a traves del campo calculado ACCESOR nombre getCartAttribute
        $cart = auth()->user()->cart;
        $cart->status_id = 2;//Se le cambia el estado a pendiente (2)
        $cart->order_date = Carbon::now();//Se guarda la fecha en que fue realizada la orden de compra. Con la clase Carbon podemos realizar multiples operaciones con fechas (sumas, restas, comparaciones, etc)
        $cart->total = $cart->total;
        //Se realiza un UPDATE
        $cart->save();

        //A traves de una instancia de Mailable, enviamos un correo a todos los administradores
        $admins = User::whereIn('rol_id', [1, 2])->get();
        Mail::to($admins)->send(new NewOrder(auth()->user(), $cart)); //Le enviamos por parametros el usuario que realizo el pedido y su carro de compras
        //Le enviamos un email al usuario que realizo el pedido
        Mail::to($cart->user->email)->send(new OrderRequested(auth()->user(), $cart));

        //Por medio de una variable de sesion flash enviamos una notificacion
        $notification = 'Tu pedido se ha realizado correctamente. Te contactaremos pronto vía email.';
        return back()->with(compact('notification'));
    }
}
