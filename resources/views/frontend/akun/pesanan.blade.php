@extends('frontend.template')
@section('content')

<section class="shop-content" style="margin-top: 25px;">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h4 style="text-align: left;">Pesanan Saya</h4>

				<table style="width: 450px;">
					@foreach($transaksi as $p)
					<?php 
					if ($p->status == 'pending') {
						$stt = '<span class="label  label-warning">Pending</span>';
					}
					?>

					<tr style="border: 1px solid;">
						<td style="padding: 5px;">
							<div style="width: 60%; float: left;">
								<a style="color: black; text-align: left;" href="{{ url('akun/pesanan', $p->no_transaksi) }}" class="stretched-link">Pesanan #{{ $p->no_transaksi }} {!!$stt!!}</a>
								<p>
									Rp. {{ number_format($p->subtotal) }}
								</p>
							</div>
							<div style="width: 40%; float: right;">
								<h2 style="text-align: right; margin-right: 20px;">{{ $p->type_bank }}</h2>
							</div>
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</section>

@endsection