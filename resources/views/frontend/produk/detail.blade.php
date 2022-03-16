@extends('frontend.template')
@section('content')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <section class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="text-uppercase">Order Online</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop Content -->
    <section class="shop-content produk_data">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="single-shop">
                        <div>
                            <img class="img-responsive" src="{{ asset($produk->foto_produk) }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 shop-single-info">
                    <div class="shop-single-title">
                        <h3 class="text-left">{{ $produk->nama_produk }}</h3>
                    </div>
                    <div class="shop-single-price">
                        <div class="ssp pull-left">Rp.{{ $produk->harga }}<span></span></div>
                    </div>
                    <p>{{ $produk->keterangan }}</p>
                    <div class="quantity">
                        <input type="hidden" value="{{ $produk->id }}" class="prod_id">
                        <input type="number" class="qty_input" placeholder="1" value="1" max="{{ $produk->qty }}">
                        <a href="./shop_checkout.html" class="btn btn-success left-space-sm pull-right">Beli</a>
                        <button type="button" class="btn btn-warning addToCartBtn left-space-sm pull-right">Tambah
                            Keranjang</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.addToCartBtn').click(function(e) {
                e.preventDefault();
                let produk_id = $(this).closest('.produk_data').find('.prod_id').val();
                let produk_qty = $(this).closest('.produk_data').find('.qty_input').val();

                $.ajax({
                    type: "POST",
                    url: "/tambah-keranjang",
                    data: {
                        'produk_id': produk_id,
                        'produk_qty': produk_qty,
                    },
                    success: function(response) {
                        if (response.status == 2) {
                            swal(
                                'Oops...',
                                'Produk Ini Sudah Ditambahkan di Keranjang',
                                'error'
                            )
                        } else {
                            swal(
                                'Data Berhasil Di Input',
                                'success'
                            );
                        }
                    }
                });
            });
        })
    </script>
@endsection
