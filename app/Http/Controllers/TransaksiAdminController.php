<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiAdminController extends Controller
{
    public function index(){
        $data = Transaksi::all();
        return view('admin.transaksi.index', compact('data'));
    }
}
