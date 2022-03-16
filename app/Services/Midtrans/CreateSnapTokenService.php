<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct()
    {
        parent::__construct();
    }

    public function getSnapToken()
    {
        $user = DB::table('users')->where('id', Auth::id())->first();
        $keranjang = DB::table('keranjang')->select('keranjang.*', 'produk.nama_produk', 'produk.harga')->where('user_id', Auth::id())->join('produk', 'produk.id', '=', 'keranjang.prod_id')->get();

        $transaction_details = [
            'order_id' => date('dmYHis'),
            'gross_amount' => '200000',
        ];

        foreach ($keranjang as $k) {
            $item_details[] = array(
                'id' => $k->prod_id,
                'price' => $k->harga,
                'quantity' => $k->prod_qty,
                'name' => $k->nama_produk
            );
        }

        $customer_details = [
            'first_name' => $user->name,
            'email' => $user->email,
            'phone' => '081234567890',
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}