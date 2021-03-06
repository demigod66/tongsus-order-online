@extends('frontend.template')
@section('content')

<!-- Cart Table -->
<section class="shop-content" style="margin-top: 25px;">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="cart-table table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Price</th>
                            <th width="10px">Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($cek_keranjang != 0)
                        @php
                        $subtotal = 0;
                        @endphp
                        @foreach ($keranjang as $ker)
                        @php
                        $total = $ker->harga * $ker->prod_qty;
                        @endphp
                        <tr>
                            <td>
                                <a href="javascript::void(0)" class="remove" data-id="{{ $ker->id }}"><i class="fa fa-times"></i></a>
                            </td>
                            <td>
                                <a href="{{ url('halaman/produk/detail', $ker->id) }}"><img src="{{ $ker->foto_produk }}" alt="" height="90" width="90"></a>
                                <a href="{{ url('halaman/produk/detail', $ker->id) }}">{{ $ker->nama_produk }}</a>
                            </td>
                            <td>
                                <span class="amount">Rp. {{ number_format($ker->harga) }}</span>
                            </td>
                            <td>
                                <div class="quantity">
                                    <input type="number" name="qty" id="qty_{{ $ker->id }}" value="{{ $ker->prod_qty }}" class="form-control qty" min="1" data-id="{{ $ker->id }}">
                                </div>
                            </td>
                            <td>
                                <span class="amount">Rp. {{ number_format($ker->harga * $ker->prod_qty) }}</span>
                            </td>
                        </tr>
                        @php
                        $subtotal += $total;
                        @endphp
                        @endforeach
                        <tr>
                            <td colspan="4">Subtotal</td>
                            <td>Rp. {{ number_format($subtotal) }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="actions">
                                <div class="col-md-12">
                                    <div class="cart-btn">
                                        <button class="btn btn-success" type="button" id="pay-button">Bayar Sekarang</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="5" align="center">Produk Masih Kosong</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <form id="payment-form" method="POST" action="{{ url('finish') }}">
                    @csrf
                    <input type="hidden" name="result_json" id="result_json" value=""></div>
                </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $('.qty').on('change', function(){
            var id = $(this).data('id');
            var qty = $('#qty_'+id).val();

            $.ajax({
                url : '/update-keranjang',
                type : "POST",
                data : {
                    id: id,
                    qty: qty
                },
                success: function(){
                    location.reload();
                }
            })
        })

        $('.remove').on('click', function(){
            var id = $(this).data('id');

            $.ajax({
                url : '/remove-keranjang',
                type : "POST",
                data : {
                    id: id
                },
                success: function(){
                    location.reload();
                }
            })
        })
    })
</script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();
        
        snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result_json').innerHTML += JSON.stringify(result, null, 2);
                    $('#result_json').val(JSON.stringify(result));
                    $('#payment-form').submit();
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result_json').innerHTML += JSON.stringify(result, null, 2);
                    $('#result_json').val(JSON.stringify(result));
                    $('#payment-form').submit();
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result_json').innerHTML += JSON.stringify(result, null, 2);
                    $('#result_json').val(JSON.stringify(result));
                    $('#payment-form').submit();
                }
            });
    });
</script>

@endsection
