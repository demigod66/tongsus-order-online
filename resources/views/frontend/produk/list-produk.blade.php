@extends('frontend.template')
@section('content')

<section class="menu menu2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header wow fadeInDown">
                    <h1>Tampilan Semua Produk</h1>
                </div>
            </div>
        </div>
        <div class="food-menu wow fadeInUp">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
            <div class="row menu-items4">
                @foreach ( $produk as $prod )
                <div class="menu-item4 col-sm-4 col-xs-12 starter dinner desserts">
                    <div class="menu-info">
                        <img src="{{  asset($prod->foto_produk) }}" class="img-responsive" alt="" />
                        <a href="{{ url('halaman/produk/detail', $prod->id) }}">
                            <div class="menu4-overlay">
                                <h4>{{ $prod->nama_produk }}</h4>
                                <p>{{ $prod->keterangan }}</p>
                                <span class="price">{{ $prod->harga_produk }}</span>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
