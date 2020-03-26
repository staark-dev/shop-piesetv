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
                                        <img src="{{ $product->image }}">
                                    </a>
                                </div>
                                </div> <!-- slider-product.// -->

                                @if(!empty($product->gallery))
                                <div class="thumbs-wrap">
                                    <a href="" class="item-thumb"> <img src="bootstrap-ecommerce-html/images/items/12.jpg"></a>
                                    <a href="" class="item-thumb"> <img src="bootstrap-ecommerce-html/images/items/12-1.jpg"></a>
                                    <a href="" class="item-thumb"> <img src="bootstrap-ecommerce-html/images/items/12-2.jpg"></a>
                                </div> <!-- slider-nav.// -->
                                @endif

                            </article> <!-- gallery-wrap .end// -->
                        </aside>
                        <main class="col-md-6 border-left">
                            <article class="content-body">
                                <h2 class="title">{{ $product->title }}</h2>
                            
                                <div class="rating-wrap my-3">
                                    <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 orders </small>
                                </div>
                            
                                <div class="mb-3">
                                    <var class="price h4">${{ $product->price }}</var>
                                </div> <!-- price-detail-wrap .// -->
                                
                                <p>Virgil Abloh’s Off-White is a streetwear-inspired collection that continues to break away from the conventions of mainstream fashion. Made in Italy, these black and brown Odsy-1000 low-top sneakers.</p>
                                
                                
                                <dl class="row">
                                    <dt class="col-sm-3">Model#</dt>
                                    <dd class="col-sm-9">A200 PSAE6E-06P00HGR</dd>
                                
                                    <dt class="col-sm-3">Color</dt>
                                    <dd class="col-sm-9">Blue</dd>
                                
                                    <dt class="col-sm-3">Delivery</dt>
                                    <dd class="col-sm-9">Europe</dd>
                                </dl>

                                <hr>
                                <div class="form-row">
                                    <div class="col-2">
                                        <select class="form-control">
                                              <option> 1 </option>
                                              <option> 2 </option>
                                              <option> 3 </option>
                                          </select>
                                    </div> <!-- col.// -->
                                     <!-- col.// -->
                                    <div class="col">
                                        <a href="#" class="btn  btn-primary w-100"> <span class="text">Add to cart</span> <i class="fas fa-shopping-cart"></i>  </a>
                                    </div> <!-- col.// -->
                                    <div class="col">
                                        <a href="#" class="btn  btn-light"> <i class="fas fa-heart"></i>  </a>
                                    </div> <!-- col.// -->
                                </div>
                            </article> <!-- product-info-aside .// -->
                        </main> <!-- col.// -->
                    </div> <!-- row.// -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection