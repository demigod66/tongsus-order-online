<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Produk;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class FrontEndController extends Controller
{

    public function index()
    {
        $produk = Produk::paginate(3);
        $about = About::where('id', 1)->first();

        return view('frontend.home', compact('produk', 'about'));
    }

    // public function halaman()
    // {
    //     return redirect('halaman/home');
    // }

    // public function home()
    // {
    //     $slider = Slider::all();
    //     $produk = Produk::all();
    //     $about = About::where('id', 3)->first();

    //     return view('frontend.index', compact('slider', 'about', 'produk'));
    // }

    // public function produk()
    // {
    //     $produk = Produk::all();
    //     return view('frontend.produk.produk', compact('produk'));
    // }

    // public function about()
    // {
    //     $about = About::where('id', 3)->first();
    //     return view('frontend.about.about', compact('about'));
    // }

    public function list_produk(){
        $about = About::where('id', 1)->first();
        $produk = Produk::all();
        return view('frontend.produk.list-produk', compact('produk','about'));
    }

    public function detail_produk($id)
    {
        $about = About::where('id', 1)->first();
        $produk = Produk::where('id', $id)->first();
        return view('frontend.produk.detail', compact('produk', 'about'));
    }
}
