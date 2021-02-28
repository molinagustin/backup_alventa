<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Variable para redirigirlo hacia la pestaña de carro de compras
        $cart = false;
        //Variable que contiene los carros que esten en otro estado distinto a activo
        $carts = Auth::user()->carts->whereNotIn('status_id', '1');
        //return view('home')->with('active', $cart, compact('carts'));
        return view('home')->with(compact('carts', 'cart'));
    }

    public function cart()
    {
        //Variable para redirigirlo hacia la pestaña de carro de compras
        $cart = true;
        //Variable que contiene los carros que esten en otro estado distinto a activo
        $carts = Auth::user()->carts->whereNotIn('status_id', '1');
        return view('home')->with(compact('carts', 'cart'));
    }
}
