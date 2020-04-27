@extends('layouts.app')

@section('navigation')
    @include('layouts.partials.navigation')
@endsection

@section('header-banner')
<section class="section-intro">
    <div class="intro-banner-wrap">
        <img src="{{ Storage::disk('public')->url('images/banners/banner.jpg') }}" class="w-100 img-fluid">
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
                                <div class="mt-2">
                                    <var class="price">{{ $item->price }} Ron</var>
                                    <a href="{{ route('cart.store', ['product' => $item->id]) }}" class="btn btn-sm btn-outline-primary float-right">Adauga in cos <i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </figcaption>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</section>
@endsection
