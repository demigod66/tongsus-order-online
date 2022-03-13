<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $fillable = [
        'user_id',
        'prod_id',
        'prod_qty'
    ];

    public function Produk()
    {
        return $this->belongsTo('App\Models\Produk', 'prod_id');
    }
}
