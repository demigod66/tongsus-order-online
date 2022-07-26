@extends('frontend.template')

@section('content')
    <!-- Home page-->
    <section class="home">
        <div class="tittle-block">
            <div class="logo">
                <a href="./index.html">
                    <img src="{{ asset('frontend/img/logo.png') }}" alt="logo">
                </a>
            </div>
            <h1>DELICIOUS Food</h1>
            <h2>Tomato is a delitious restaurant website template</h2>
        </div>
        <div class="scroll-down">
            <a href="#about">
                <img src="{{ asset('frontend/img/arrow-down.png') }}" alt="down-arrow">
            </a>
        </div>
    </section>

    <!-- About page-->
    <section class="about" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header wow fadeInDown">
                        <h1>Tentang Kami<small>Tentang Kami</small></h1>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp">
                <div class="col-md-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 hidden-sm about-photo">
                                <div class="image-thumb">
                                    <img src="{{ asset($about->foto_deskripsi) }}" class="img-responsive" alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <p>
                        {!! $about->deskripsi !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header wow fadeInDown">
                        <h1>Produk Kami<small>Ini Adalah Beberapa Produk Kami</small></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="shop-products">
                        <div class="row">
                            @foreach ($produk as $pr)
                                <div class="col-md-4 col-sm-6">
                                    <div class="product-info">
                                        <div class="product-img">
                                            <img src="{{ asset($pr->foto_produk) }}" width="240" height="240" alt="" />
                                        </div>
                                        <h4><a href="">{{ $pr->nama_produk }}</a></h4>
                                        <div class="product-price">{{ $pr->harga }}</div>
                                        <div class="shop-meta">
                                            <a href="{{ url('halaman/produk/detail', $pr->id) }}"
                                                class="pull-left"><i class="fa fa-shopping-cart"></i> Pesan</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ url('halaman/list-produk')}}" class="btn btn-default load-more">Load more</a>
                </div>
            </div>
        </div>
    </section>
@endsection
