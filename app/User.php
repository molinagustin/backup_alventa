<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Asociacion de modelo con ROL
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    //Asociacion de modelo con CART
    public function carts()
    {
        return $this->hasMany(Cart::class); //Un usuario podra tener muchos carros a lo largo de sus visitas al sitio
    }

    //Accesor para el ID del carro de compras
    public function getCartAttribute()
    {
        //Busco dentro de este usuario, por medio de la asociacion con los carritos, los que tengan status_id = 1 que son los activos y devuelvo el primero encontrado
        $cart = $this->carts()->where('status_id', '1')->first();

        //Si encontro un carro activo, le devuelvo el id del mismo
        if ($cart) {
            return $cart;
        }
        //Sino creo un carro nuevo que por defecto estara en status_id = 1
        else {
            $cart = new Cart();
            $cart->user_id = $this->id;
            $cart->save(); //Insert

            return $cart;
        }
    }
}
