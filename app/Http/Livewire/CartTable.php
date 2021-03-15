<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\CartDetail;

class CartTable extends Component
{
    public function addCartDetail($id)
    {
        $detail = CartDetail::find($id);
        $detail->quantity++;
        if(! ($detail->quantity > 100))
            $detail->save();
    }

    public function removeCartDetail($id)
    {
        $detail = CartDetail::find($id);
        $detail->quantity--;
        if(! ($detail->quantity <= 0))
            $detail->save();
    }

    public function render()
    {        
        return view('livewire.cart-table');
    }
}
