<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
	protected $table = 'transaksi';
	protected $fillable = ['no_transaksi', 'user_id', 'subtotal', 'status', 'pesan', 'type_bayar', 'type_bank', 'va_number', 'keterangan', 'pdf_url'];
}
