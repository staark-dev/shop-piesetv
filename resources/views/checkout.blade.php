@extends('layouts.app')

@section('header-banner')
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Finalizează comanda</h2>
    </div>
</section>
@endsection

@php $totalPrice = 0; $cartItems = null; @endphp
@section('content')
@guest
	Client Nou
@else
@if ($errors->any())
<div class="row m-5">
	<div class="col-md-8">
		<div class="alert alert-danger" role="alert">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endif

<form action="{{ route('cart.order.complete') }}" method="post">
	@csrf
	<div class="row m-5">
		<div class="col-md-12">
			<div class="row">
				<div class="form-group col-md-3">
					<label for="name">Nume</label>
					<input id="name" class="form-control" type="text" name="billing_first_name">
				</div>

				<div class="form-group col-md-3">
					<label for="prename">Prenume *</label>
					<input id="prename" class="form-control" type="text" name="billing_last_name">
				</div>

				<div class="form-group col-md-5">
					<label for="my-input">Note comandă (opțional)</label>
					<textarea name="order_comments" class="form-control" id="order_comments" placeholder="Observații despre comanda ta, de exemplu: anumite detalii pentru livrare." rows="2" cols="5"></textarea>
				</div>
				

				<div class="form-group col-md-6">
					<label for="company">Denumire companie (opțional)</label>
					<input id="company" class="form-control" type="text" name="billing_company">
				</div>

				<div class="form-group col-md-8">
					<label for="company">Ţara *</label>
					<p class="text-muted"><strong>România</strong></p>
					<input type="hidden" name="billing_country" id="billing_country" value="RO" autocomplete="off" class="country_to_state" readonly="readonly">
				</div>

				<div class="form-group col-md-6">
					<label for="company">Adresa *</label>
					<input id="company" class="form-control mb-2" type="text" placeholder="Nume stradă, număr etc." name="billing_address1">
					<input id="company" class="form-control" type="text" placeholder="Apartament, garsonieră, unitate etc. (opțional)" name="billing_address2">
				</div>

				<div class="form-group col-md-8">
					<label for="company">Localitate *</label>
					<input id="company" class=" col-md-9 form-control" type="text" name="billing_localitate">
				</div>

				<div class="form-group col-md-8">
					<label for="company">Judeţ (opțional)</label>
					<input id="company" class="col-md-9 form-control" type="text" name="billing_judet">
				</div>

				<div class="form-group col-md-8">
					<label for="company">Cod poştal *</label>
					<input id="company" class="col-md-9 form-control" type="text" name="billing_postal_code">
				</div>

				<div class="form-group col-md-8">
					<label for="company">Telefon *</label>
					<input id="company" class="col-md-9 form-control" type="text" name="billing_phone">
				</div>

				<div class="form-group col-md-8">
					<label for="company">Adresă email *</label>
					<input id="company" class="col-md-9 form-control" type="text" name="billing_email">
				</div>
			</div>
		</div>
	</div>

	<div class="row m-5">
		<aside class="col-md-12">
			<output>
			<div class="card">
				<article class="card-body">
					<header class="mb-4">
						<h4 class="card-title">Comanda ta</h4>
					</header>
						<div class="row">
							@foreach (json_decode($cart->product_info) as $key => $value)
								@foreach ($value as $keys => $item) 
								@php 
									$cartItems += 1;
									$totalPrice += $item->price; 
								@endphp
								<div class="col-md-6">
									<figure class="itemside mb-3">
										<div class="aside">
											<img src="{{ Storage::disk('public')->url('images/items/' . $item->image) }}" class="border img-xs">
										</div>
	
										<figcaption class="info">
											<p>{{ $item->name }}</p>
											<span>{{ $item->quantity }}x {{ $item->price }} Ron = Total: {!! $item->quantity * $item->price !!} Ron</span>
										</figcaption>
									</figure>
								</div>
								@endforeach
							@endforeach
						</div>
				</article>
				<article class="card-body border-top">
	
					<dl class="row">
					  	<dt class="col-sm-10">Subtotal:</dt>
					  	<dd class="col-sm-2 text-right"><strong>{{ $totalPrice }},00 Ron</strong></dd>
	
						<dt class="col-sm-10">Livrare: <span class="float-right text-muted"></span></dt>
						<dd class="col-sm-2 text-right text-success"><strong>Curier: 25,00 Ron</strong></dd>

					  	<dt class="col-sm-10">Total:</dt>
					  	<dd class="col-sm-2 text-right"><strong class="h5 text-dark">{{ $totalPrice + 25 }} Ron</strong></dd>
					</dl>
				</article>
			</div>	
			</output>
		</aside>

		<aside class="col-md-6 mt-5 pt-2 border-top">
			<button type="submit" class="mt-4 btn btn-primary btn-block">Plaseaza comanda</button>
		</aside>
	</div>
</form>
@endguest
@endsection