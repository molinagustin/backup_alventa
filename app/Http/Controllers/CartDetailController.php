<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cart;
use App\CartDetail;

class CartDetailController extends Controller
{
    public function store(Request $request)
    {
        $cartDetail = new CartDetail();
        $cartDetail->cart_id = auth()->user()->cart->id; //Por medio de un campo calculado getCartIdAttribute obtengo el carrito activo del cliente que ha iniciado sesion
        $cartDetail->product_id = $request->product_id;
        $cartDetail->quantity = $request->quantity;
        $cartDetail->save(); //Realiza un Insert    

        //De esta forma se crea una variable de sesion flash que se envia a traves de la redireccion.
        //Solo van a estar disponibles durante la peticion siguiente, al volver a recargar la pagina ya no estara disponible
        $notification = 'El producto fue agregado al carro de compras exitosamente.';
        return back()->with(compact('notification'));
    }

    public function destroy(Request $request)
    {
        $cartDetail = CartDetail::find($request->input('cart_detail_id'));

        //Se hace una comprobacion para determinar si el id del carro de compras activo corresponde efectivamente al del usuario logueado
        //De esa forma no se puede eliminar manualmente por medio de otro usuario cambiando los valores VALUE de las etiquetas en el Inspector de Google
        if ($cartDetail->cart_id == auth()->user()->cart->id)
            $cartDetail->delete(); //Realiza un Delete del registro en la BD    

        //De esta forma se crea una variable de sesion flash que se envia a traves de la redireccion.
        //Solo van a estar disponibles durante la peticion siguiente, al volver a recargar la pagina ya no estara disponible
        $notification = 'El producto se elimino del carro de compras exitosamente.';
        return back()->with(compact('notification'));
    }
}
