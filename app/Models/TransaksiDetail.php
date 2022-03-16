<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
	protected $table = 'transaksi_detail';
	protected $fillable = ['id_transaksi', 'id_produk', 'harga', 'qty', 'total'];
	public $timestamps = false;
}
