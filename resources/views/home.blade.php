@extends('layouts.app')

@section('navigation')
    @include('layouts.partials.navigation')
@endsection

@section('header-banner')
<section class="section-intro">
    <div class="intro-banner-wrap" style="margin-left:20.5%;margin-right:20.5%">
        <img src="{{ Storage::disk('public')->url('images/banners/banner.jpg') }}" class="w-100" style="height: 400px;border-radius:7px">
    </div>
</section>
@endsection

@section('content')
@if(Session::has('message'))
  <p class="alert alert-success">{{ Session::get('message') }}</p>
@endif

<section class="section-content padding-y" style="min-height:84vh">
    <section class="section-content">
        <div class="container">
            <header class="section-heading">
                <h3 class="section-title">Random products</h3>
            </header>
            <div class="row">
                @foreach ($products as $item)
                    <div class="col-md-3">
                        <div href="{{ route('product.view', ['slug' => $item->slug]) }}" class="card card-product-grid">
                            <a href="{{ route('product.view', ['slug' => $item->slug]) }}" class="img-wrap"> <img src="{{ Storage::disk('public')->url('images/items/' . $item->image) }}"> </a>
                            <figcaption class="info-wrap">
                                <a href="{{ route('product.view', ['slug' => $item->slug]) }}" class="title">{{ $item->title }}</a>
                                <div class="mt-2" style="text-align: center">
                                    <var class="price">{{ $item->price }} Ron</var>
                                    <div>
                                    <a href="{{ route('cart.store', ['product' => $item->id]) }}" class="btn btn-sm btn-primary ">Adauga in cos <i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            </figcaption>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel" style=" margin-bottom:3%;width:1130px">
                <div class="carousel-inner">
                  <div class="carousel-item active" data-interval="3000">
                    <img src="https://upgrade.shop-piesetv.ro/storage/images/items/ecbd565fe2464ee3.jpg" class="d-block w-100" alt="" style="height:500px">
                  </div>
                  <div class="carousel-item" data-interval="3000">
                    <img src="https://upgrade.shop-piesetv.ro/storage/images/items/v8-ms80104-lf1v065-2020-03-24-5e7a00a88b8d9.jpg" class="d-block w-100" alt="" style="height:500px">
                  </div>
                  <div class="carousel-item" data-interval="3000">
                    <img src="https://upgrade.shop-piesetv.ro/storage/images/items/e09cffe0d895aa32.jpg" class="d-block w-100" alt="" style="height:500px">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
        </div>
    </section>
</section>
@endsection

