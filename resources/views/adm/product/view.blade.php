@extends('adm.layouts.body')

@section('content')
<div class="container">    
    <div class="row">
        <div class="col-md-8">				
            <div class="panel panel-default  panel--styled">
                <div class="panel-body">
                    <div class="col-md-12 panelTop">	
                        <div class="col-md-4">	
                            <img class="img-responsive" src="{{ Storage::disk('public')->url('/images/items/' . $product->image) }}" alt=""/>
                        </div>
                        <div class="col-md-8">	
                            <h2>{{ $product->title }}</h2>
                            {!! nl2br($product->description) !!}
                        </div>
                    </div>
                    
                    <div class="col-md-12 panelBottom">
                        <div class="col-md-4 text-center"></div>
                        <div class="col-md-4 text-left">
                            <h5>Price <span class="itemPrice">{{ $product->price }} RON</span></h5>
                        </div>
                        <div class="col-md-4">
                            <div class="stars">
                             <div id="stars" class="starrr"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container content-box-large mt-5" style="display: none">
    <div class="row">
        <div class="col-md-12">
            <div class="product col-md-3 service-image-left">
                <div class="center">
                    <img id="item-display" src="{{ Storage::disk('public')->url('/images/items/' . $product->image) }}" alt="">
                </div>
            </div>
            
            @if(!empty($product->gallery) && is_array($product->gallery))
            <div class="container service1-items col-sm-2 col-md-2 pull-left">
                @foreach (json_decode($product->gallery, true) as $item)
                    <a id="item-1" class="service1-item">
                        <img src="{{ Storage::disk('public')->url('/images/items/' . $item) }}" alt="">
                    </a>
                @endforeach
            </div>
            @endif
        </div>
            
        <div class="col-md-7">
            <div class="product-title">{{ $product->title }}</div>
            <div class="product-desc">{!! nl2br($product->description) !!}</div>
            <hr>
            <div class="product-price">{{ $product->price }} RON</div>
            <div class="product-stock">In Stock</div>
            <hr>
            <div class="btn-group cart">
                <button type="button" class="btn btn-success">
                    Edit 
                </button>
            </div>
            <div class="btn-group wishlist">
                <button type="button" class="btn btn-danger">
                    Delete 
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <style>
        /*----------------------
Product Card Styles 
----------------------*/

.panelTop {
    padding: 30px;
}

.panelBottom {
    border-top: 1px solid #e7e7e7;
    padding-top: 20px;
}
.btn-add-to-cart {
    background: #FD5A5B;
    color: #fff;
}
.btn.btn-add-to-cart.focus, .btn.btn-add-to-cart:focus, .btn.btn-add-to-cart:hover  {
	color: #fff;   
    background: #FD7172;
	outline: none;
}
.btn-add-to-cart:active {
	background: #F9494B;
	outline: none;
}


span.itemPrice {
    font-size: 24px;
    color: #FA5B58;
}


/*----------------------
##star Rating Styles 
----------------------*/
.stars {
    padding-top: 10px;
	width: 100%;
	display: inline-block;
}
span.glyphicon {
    padding: 5px;
}
.glyphicon-star-empty {
    color: #9d9d9d;
}
.glyphicon-star-empty, .glyphicon-star { 
    font-size: 18px;
}
.glyphicon-star {
    color: #FD4;
    transition: all .25s;
}   
.glyphicon-star:hover { 
    transform: rotate(-15deg) scale(1.3); 
}
    </style>
@endsection