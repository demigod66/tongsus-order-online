<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Produk;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{

    public function index()
    {
        return redirect('halaman/home');
    }

    public function halaman()
    {
        return redirect('halaman/home');
    }

    public function home()
    {
        $slider = Slider::all();
        $produk = Produk::all();
        $about = About::where('id', 3)->first();

        return view('frontend.index', compact('slider', 'about', 'produk'));
    }

    public function produk()
    {
        $produk = Produk::all();
        return view('frontend.produk.produk', compact('produk'));
    }

    public function about()
    {
        $about = About::where('id', 3)->first();
        return view('frontend.about.about', compact('about'));
    }
}
