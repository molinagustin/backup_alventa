<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function details()
    {
        return $this->hasMany(CartDetail::class);
    }

    public function status()
    {
        return $this->belongsTo(CartStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
