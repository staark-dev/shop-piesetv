@extends('layouts.app')

@section('header-banner')
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Finalizare comanda</h2>
    </div>
</section>
@endsection

@section('content')
<div class="row">
	<aside class="col-md-9">
		<output>
		<div class="card">
			<article class="card-body">
				<header class="mb-4">
					<h4 class="card-title">Review cart</h4>
				</header>
					<div class="row">
						<div class="col-md-6">
							<figure class="itemside  mb-3">
								<div class="aside"><img src="bootstrap-ecommerce-html/images/items/1.jpg" class="border img-xs"></div>
								<figcaption class="info">
									<p>Name of the product goes here or title </p>
									<span>2x $290 = Total: $430 </span>
								</figcaption>
							</figure>
						</div> <!-- col.// -->
						<div class="col-md-6">
							<figure class="itemside  mb-3">
								<div class="aside"><img src="bootstrap-ecommerce-html/images/items/2.jpg" class="border img-xs"></div>
								<figcaption class="info">
									<p>Name of the product goes here or title </p>
									<span>2x $290 = Total: $430 </span>
								</figcaption>
							</figure>
						</div> <!-- col.// -->
						<div class="col-md-6">
							<figure class="itemside mb-3">
								<div class="aside"><img src="bootstrap-ecommerce-html/images/items/3.jpg" class="border img-xs"></div>
								<figcaption class="info">
									<p>Name of the product goes here or title </p>
									<span>1x $290 = Total: $290 </span>
								</figcaption>
							</figure>
						</div> <!-- col.// -->
						<div class="col-md-6">
							<figure class="itemside  mb-3">
								<div class="aside"><img src="bootstrap-ecommerce-html/images/items/4.jpg" class="border img-xs"></div>
								<figcaption class="info">
									<p>Name of the product goes here or title </p>
									<span>4x $290 = Total: $430 </span>
								</figcaption>
							</figure>
						</div> <!-- col.// -->
					</div> <!-- row.// -->
			</article> <!-- card-body.// -->
			<article class="card-body border-top">

				<dl class="row">
				  <dt class="col-sm-10">Subtotal: <span class="float-right text-muted">2 items</span></dt>
				  <dd class="col-sm-2 text-right"><strong>$1,568</strong></dd>

				  <dt class="col-sm-10">Discount: <span class="float-right text-muted">10% offer</span></dt>
				  <dd class="col-sm-2 text-danger text-right"><strong>$29</strong></dd>

				  <dt class="col-sm-10">Delivery charge: <span class="float-right text-muted">Express delivery</span></dt>
				  <dd class="col-sm-2 text-right"><strong>$120</strong></dd>

				  <dt class="col-sm-10">Tax: <span class="float-right text-muted">5%</span></dt>
				  <dd class="col-sm-2 text-right text-success"><strong>$7</strong></dd>

				  <dt class="col-sm-10">Total:</dt>
				  <dd class="col-sm-2 text-right"><strong class="h5 text-dark">$1,650</strong></dd>
				</dl>
			</article> <!-- card-body.// -->
		</div>	
		</output>
	</aside>
	<aside class="col-md-3">
		<output>
			<div class="card">
		<div class="card-body">
			<p>Dropdown sample</p>
			<div class="dropdown">
			  <a href="#" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown">
			  Show cart
			  </a>
			  <div class="dropdown-menu p-3 dropdown-menu-right" style="min-width:280px;">
				   <figure class="itemside mb-3">
					<div class="aside"><img src="bootstrap-ecommerce-html/images/items/1.jpg" class="img-sm border"></div>
					<figcaption class="info align-self-center">
						<p class="title">Name of item nice iteme</p>
						<a href="#" class="float-right"><i class="fa fa-trash"></i></a>
						<div class="price">$250</div> <!-- price-wrap.// -->
					</figcaption>
				</figure>
				<figure class="itemside mb-3">
					<div class="aside"><img src="bootstrap-ecommerce-html/images/items/2.jpg" class="img-sm border"></div>
					<figcaption class="info align-self-center">
						<p class="title">Some other item name is here</p>
						<a href="#" class="float-right"><i class="fa fa-trash"></i></a>
						<div class="price">$250</div> <!-- price-wrap.// -->
					</figcaption>
				</figure>
				<figure class="itemside mb-3">
					<div class="aside"><img src="bootstrap-ecommerce-html/images/items/3.jpg" class="img-sm border"></div>
					<figcaption class="info align-self-center">
						<p class="title">Another name of item  item</p>
						<a href="#" class="float-right"><i class="fa fa-trash"></i></a>
						<div class="price">$250</div> <!-- price-wrap.// -->
					</figcaption>
				</figure>
				<div class="price-wrap text-center py-3 border-top">Subtotal: <strong class="h5 price">$1200</strong></div>
				<a href="" class="btn btn-primary btn-block"> Checkout </a>
			  </div> <!-- drowpdown-menu.// -->
			</div>  <!-- dropdown.// -->

		</div> <!-- card-body.// -->
		</div> <!-- card.// -->
		</output>
	</aside>
</div>
@endsection