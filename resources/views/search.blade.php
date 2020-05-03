@extends('layouts.app')

@section('header-banner')
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Cautare produse</h2>
        <nav>
            <ol class="breadcrumb text-white">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Acasa</a></li>
                <li class="breadcrumb-item active" aria-current="page">Articole gasite ({{ count($search) }})</li>
            </ol>  
        </nav>
</section>
@endsection

@section('content')
<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                @foreach ($search as $item)
                <article class="card card-product-list">
                    <div class="row no-gutters">
                        <aside class="col-md-3">
                            <a href="#" class="img-wrap">
                                <img src="{{ Storage::disk('public')->url('images/items/' . $item->image) }}">
                            </a>
                        </aside>

                        <div class="col-md-6">
                            <div class="info-main">
                                <a href="#" class="h5 title"> {{ $item->title }} </a>
                                <div class="rating-wrap mb-3">
                                    <div class="label-rating">
                                        Postat in {{ $item->categories->name }}
                                        @if($item->stock > 0)
                                        <p class="text-success">Disponibil pentru comanda</p>
                                        @else
                                        <p class="text-danger">Nu mai este disponibil</p>
                                        @endif
                                    </div>
                                </div> <!-- rating-wrap.// -->
                                
                                <p> {!! nl2br($item->description) !!} </p>
                            </div> <!-- info-main.// -->
                        </div> <!-- col.// -->
                        <aside class="col-sm-3">
                            <div class="info-aside">
                                <div class="price-wrap">
                                    <span class="price h5"> {{ $item->price }} RON </span>
                                </div> <!-- info-price-detail // -->
                                <p class="text-success">Free shipping</p>
                                <br>
                                <p>
                                    <a href="{{ route('product.view', ['slug' => $item->slug]) }}" class="btn btn-primary btn-block"> Detalii </a>
                                    <a href="{{ route('cart.store', ['product' => $item->id]) }}" class="btn btn-light btn-block"><i class="fa fa-shopping-cart"></i> 
                                        <span class="text">Adauga in cos</span>
                                    </a>
                                </p>
                            </div> <!-- info-aside.// -->
                        </aside> <!-- col.// -->
                    </div> <!-- row.// -->
                </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection