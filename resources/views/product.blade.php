@extends('layouts.app')

@section('header-banner')
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Detalii Produs</h2>
        <nav>
        <ol class="breadcrumb text-white">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $product->categories->name }}</a></li>
        </ol>  
        </nav>
    </div> <!-- container //  -->
</section>
@endsection

@section('add_style')
    .section-pagetop {
        padding: 45px 0;
    }
    .padding-y {
        padding-top: 40px;
        padding-bottom: 40px;
    }
    
    .breadcrumb {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        padding: 0 0;
        margin-bottom: 0;
        list-style: none;
        background-color: transparent;
        border-radius: 0.37rem;
    }

    article, aside, figcaption, figure, footer, header, hgroup, main, nav, section {
        display: block;
    }

    .filter-group .card-header {
        border-bottom: 0;
        background: transparent;
    }
@endsection

@section('content')
<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-8">
                <div class="card">
                    <div class="row no-gutters">
                        <aside class="col-md-6">
                            <article class="gallery-wrap">
                                <div class="img-big-wrap">
                                <div>
                                    <a href="#">
                                        <img src="{{ Storage::disk('public')->url('images/items/' . $product->image) }}">
                                    </a>
                                </div>
                                </div> <!-- slider-product.// -->

                                @if(!empty(json_decode($product->gallery)) && count(json_decode($product->gallery)) > 0)
                                <div class="thumbs-wrap">
                                    @foreach (json_decode($product->gallery) as $item)
                                    <a href="#" class="item-thumb"> <img src="{{ Storage::disk('public')->url('images/items/' . $item) }}"></a>
                                    @endforeach
                                </div>
                                @endif

                            </article> <!-- gallery-wrap .end// -->
                        </aside>
                        <main class="col-md-6 border-left">
                            <article class="content-body">
                                <h2 class="title">{{ $product->title }}</h2>
                            
                                <div class="rating-wrap my-3">
                                    <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 0 orders </small>
                                </div>
                            
                                <div class="mb-3">
                                    <var class="price h4">{{ $product->price }} Ron</var>
                                </div>
                                
                                <p>
                                    {!! nl2br($product->description) !!}
                                </p>
                                
                                <hr>
                                <div class="form-row">
                                    <div class="col-2">
                                        <select class="form-control">
                                            @for ($i = 1; $i < $product->stock+1; $i++)
                                                <option value="{{ $i }}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <a href="{{ route('cart.store', ['product' => $product->id]) }}" class="btn  btn-primary w-100"> <span class="text">Adauga in cos</span> <i class="fas fa-shopping-cart"></i>  </a>
                                    </div>
                                </div>
                            </article>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection