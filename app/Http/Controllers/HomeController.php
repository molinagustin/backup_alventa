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
        //Variable para redirigirlo hacia la pestaña de resumen
        $redShopCart = false;
        //Variable que contiene los carros que esten en otro estado distinto a Active o Cancelled
        $carts = Auth::user()->carts->whereNotIn('status_id', ['1']);
        $carts = $carts->sortByDesc('order_date');
        //dd($carts);

        //Cuento la totalidad de ordenes realizadas por un usuario (Que el carro no este Active o Cancelled)
        $totalOrders = Auth::user()->carts->whereNotIn('status_id', ['1', '4'])->count();

        //Cuento el dinero gastado en los pedidos realizados
        $moneySpent = 0;
        foreach ($carts as $cart) {
            $moneySpent += $cart->total;
        }
        return view('home')->with(compact('carts', 'redShopCart', 'totalOrders', 'moneySpent'));
    }

    public function cart()
    {
        //Variable para redirigirlo hacia la pestaña de carro de compras
        $redShopCart = true;
        //Variable que contiene los carros que esten en otro estado distinto a Active o Cancelled
        $carts = Auth::user()->carts->whereNotIn('status_id', ['1']);
        $carts = $carts->sortByDesc('order_date');
        //dd($carts);

        //Cuento la totalidad de ordenes realizadas por un usuario (Que el carro no este Active o Cancelled)
        $totalOrders = Auth::user()->carts->whereNotIn('status_id', ['1', '4'])->count();

        //Cuento el dinero gastado en los pedidos realizados
        $moneySpent = 0;
        foreach ($carts as $cart) {
            $moneySpent += $cart->total;
        }
        return view('home')->with(compact('carts', 'redShopCart', 'totalOrders', 'moneySpent'));
    }
}
