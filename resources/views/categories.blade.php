@extends('layouts.app')

@section('header-banner')
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Category products</h2>
        <nav>
        <ol class="breadcrumb text-white">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cat.view', ['slug' => $cat->slug ]) }}">{{ $cat->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Articole</li>
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
            <aside class="col-md-3">
                <div class="card">
                    <article class="filter-group">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
                                <i class="icon-control fa fa-chevron-down"></i>
                                <h6 class="title">Product type</h6>
                            </a>
                        </header>
                        <div class="filter-content collapse show" id="collapse_1" style="">
                            <div class="card-body">
                                <form class="pb-3">
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Search">
                                  <div class="input-group-append">
                                    <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
                                  </div>
                                </div>
                                </form>
                                
                                <ul class="list-menu">
                                    @foreach ($cat->sub_categories as $item)
                                    <li><a href="{{ route('cat.sub', ['catid' => $cat->id, 'slug' => $item->slug]) }}">{{ $item->name }}</a></li>
                                    @endforeach
                                </ul>
                
                            </div> <!-- card-body.// -->
                        </div>
                    </article>

                    <article class="filter-group">
                        <header class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="">
                                <i class="icon-control fa fa-chevron-down"></i>
                                <h6 class="title">Price range </h6>
                            </a>
                        </header>
                        <div class="filter-content collapse show" id="collapse_3" style="">
                            <div class="card-body">
                                <input type="range" class="custom-range" min="0" max="100" name="">
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label>Min</label>
                                  <input class="form-control" placeholder="$0" type="number">
                                </div>
                                <div class="form-group text-right col-md-6">
                                  <label>Max</label>
                                  <input class="form-control" placeholder="$1,0000" type="number">
                                </div>
                                </div> <!-- form-row.// -->
                                <button class="btn btn-block btn-primary">Apply</button>
                            </div><!-- card-body.// -->
                        </div>
                    </article>
                </div>
            </aside>
            <main class="col-md-9">
                <header class="border-bottom mb-4 pb-3">
                    <div class="form-inline">
                        
                        <span class="mr-md-auto">{{ $cat->product->count() }} Articole disponibile </span>
                    </div>
                </header>

                <div class="row">
                    @foreach ($cat->product as $products)
                    <div class="col-md-4">
                        <figure class="card card-product-grid">
                            <div class="img-wrap"> 
                                <span class="badge badge-danger"> NEW </span>
                                <img src="{{ Storage::disk('public')->url('images/items/' . $products->image) }}">
                                <a class="btn-overlay" href="{{ route('product.view', ['slug' => $products->slug]) }}"><i class="fa fa-search-plus"></i> Quick view</a>
                            </div> <!-- img-wrap.// -->
                            <figcaption class="info-wrap">
                                <div class="fix-height">
                                    <a href="#" class="title">{{ $products->name }}</a>
                                    <div class="price-wrap mt-2">
                                        <span class="price">${{ $products->price }}</span>
                                    </div> <!-- price-wrap.// -->
                                </div>
                                <a href="#" class="btn btn-block btn-primary">Add to cart </a>
                            </figcaption>
                        </figure>
                    </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
</section>
@endsection