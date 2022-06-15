<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{About, Transaksi, TransaksiDetail};

class AkunController extends Controller
{
	public function __construct(){
		if (Auth::user()) {
			return redirect()->route('login');
		}
	}

	public function index(){
        $about = About::where('id', 1)->first();

		return view('frontend.akun.index', compact('about'));
	}

	public function pesanan(){
		$about = About::where('id', 1)->first();
		$transaksi = Transaksi::where('user_id', Auth::id())->get();

		return view('frontend.akun.pesanan', compact('about', 'transaksi'));
	}

	public function detail($no_trans){
		$about = About::where('id', 1)->first();
		$transaksi = Transaksi::where('no_transaksi', $no_trans)->first();
		$transaksi_detail = TransaksiDetail::select('transaksi_detail.*', 'produk.nama_produk')->where('id_transaksi', $transaksi->id)->join('produk', 'produk.id', '=', 'transaksi_detail.id_produk')->get();

		return view('frontend.akun.detail', compact('about', 'transaksi', 'transaksi_detail'));
	}
}
