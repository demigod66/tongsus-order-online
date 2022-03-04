<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    protected $table = 'produk';
    protected $hidden = ['id'];
    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'harga',
        'qty',
        'keterangan',
        'file',
    ];


    public function getKategori()
    {
        $query = DB::table('produk')
            ->join('kategori', 'kategori.id', '=', 'produk.kategori_id')
            ->select('produk.*', 'kategori.nama_kategori')
            ->get();

        return $query;
    }
}
