<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function tambahKeranjang(Request $request)
    {
        $produk_id = $request->input('produk_id');
        $produk_qty = $request->input('produk_qty');

        if (Auth::check()) {
            $prod_check = Produk::where('id', $produk_id)->first();

            if ($prod_check) {
                if (Keranjang::where('prod_id', $produk_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => 2]);
                } else {
                    $k_item = new Keranjang();
                    $k_item->prod_id = $produk_id;
                    $k_item->user_id = Auth::id();
                    $k_item->prod_qty = $produk_qty;
                    $k_item->save();

                    return response()->json(['status' => 1]);
                }
            }
        } else {
            return response()->json(['status' => 'Login Untuk Melanjutkan']);
        }
    }

    public function lihatKeranjang()
    {
        $user_id = Auth::id();
        $keranjang = DB::table('keranjang')
            ->join('produk', 'produk.id', '=', 'keranjang.prod_id')
            ->where('id', $user_id)
            ->get();
        $about = About::where('id', 3)->first();
        return view('frontend.produk.keranjang', compact('about', 'keranjang'));
    }
}
