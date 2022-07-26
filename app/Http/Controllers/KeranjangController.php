<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Keranjang;
use App\Models\{Produk, Transaksi, TransaksiDetail};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Midtrans\CreateSnapTokenService;
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
        $cek_keranjang = DB::table('keranjang')->where('user_id', $user_id)->count();

        if ($cek_keranjang == 0) {
            return redirect('/');
        }

        $keranjang = DB::table('keranjang')->join('produk', 'produk.id', '=', 'keranjang.prod_id')->where('user_id', $user_id)->get();
        $about = About::where('id', 1)->first();
        $midtrans = new CreateSnapTokenService();
        $snapToken = $midtrans->getSnapToken();

        return view('frontend.produk.keranjang', compact('about', 'keranjang', 'cek_keranjang', 'snapToken'));
    }

    public function removekeranjang(){
        $produk_id = Request()->id;
        $user_id = Auth::id();

        DB::table('keranjang')->where('user_id', $user_id)->where('prod_id', $produk_id)->delete();
    }

    public function updatekeranjang(){
        $produk_id = Request()->id;
        $qty = Request()->qty;
        $user_id = Auth::id();

        DB::table('keranjang')->where('user_id', $user_id)->where('prod_id', $produk_id)->update(['prod_qty' => $qty]);
    }

    public function finish(){
        $result = json_decode(Request()->result_json, true);
        $keranjang = DB::table('keranjang')->select('keranjang.*', 'produk.nama_produk', 'produk.harga')->where('user_id', Auth::id())->join('produk', 'produk.id', '=', 'keranjang.prod_id')->get();

        $transaksi = Transaksi::create([
            'no_transaksi' => $result['order_id'],
            'nama_produk' => $result['prod_id'],
            'user_id' => Auth::id(),
            'subtotal' => substr($result['gross_amount'], 0, -3),
            'status' => $result['transaction_status'],
            'pesan' => $result['status_message'],
            'type_bayar' => $result['payment_type'],
            'type_bank' => $result['va_numbers'][0]['bank'],
            'va_number' => $result['va_numbers'][0]['va_number'],
            'keterangan' => '',
            'pdf_url' => $result['pdf_url']
        ]);

        foreach ($keranjang as $k) {
            $transaksi_detail = TransaksiDetail::create([
                'id_transaksi' => $transaksi->id,
                'id_produk' => $k->prod_id,
                'harga' => $k->harga,
                'qty' => $k->prod_qty,
                'total' => $k->harga * $k->prod_qty
            ]);

            DB::table('produk')->where('id', $transaksi_detail->id_produk)->decrement('qty', $transaksi_detail->qty);
        }


        return redirect('akun/pesanan/'.$result['order_id']);
    }
}
