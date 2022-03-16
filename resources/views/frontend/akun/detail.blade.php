@extends('frontend.template')
@section('content')

<section class="shop-content" style="margin-top: 25px;">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h4 style="text-align: left;">Pesanan #{{ $transaksi->no_transaksi }}</h4>

				<table width="100%" class="cart-table table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Harga</th>
							<th>Qty</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@php
						$subtotal = 0;
						@endphp
						@foreach($transaksi_detail as $td)
						@php
						$total = $td->harga * $td->qty;
						@endphp
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $td->nama_produk }}</td>
							<td>Rp. {{ number_format($td->harga) }}</td>
							<td>{{ $td->qty }}</td>
							<td>Rp. {{ number_format($td->harga * $td->qty) }}</td>
						</tr>
						@php
						$subtotal += $total;
						@endphp
						@endforeach
						<tr>
							<td colspan="4" align="center">Subtotal</td>
							<td>Rp. {{ number_format($subtotal) }}</td>
						</tr>
					</tbody>
				</table>

				<div class="row">
					<div class="col-md-6">
						<h4>Panduan Pembayaran</h4>
						<p>
							Virtual Account : {{ $transaksi->va_number }}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection