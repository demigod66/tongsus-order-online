<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
	protected $table = 'transaksi';
	protected $fillable = ['no_transaksi','produk_id','user_id', 'subtotal', 'status', 'pesan', 'type_bayar', 'type_bank', 'va_number', 'keterangan', 'pdf_url'];

    public function user(){
       return $this->belongsTo('App\Models\User','user_id');
    }

    public function produk(){
        return $this->belongsTo('App\Models\Produk','produk_id');
     }

}
