@extends('layouts.app')

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
@endsection

@section('content')
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">My account</h2>
    </div> <!-- container //  -->
</section>

<section class="section-content padding-y bg-white">
    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <ul class="list-group">
                    <a class="list-group-item active" href="#"> Account overview  </a>
                    <a class="list-group-item" href="#"> My Orders </a>
                    <a class="list-group-item" href="#"> My wishlist </a>
                    <a class="list-group-item" href="#"> Return and refunds </a>
                    <a class="list-group-item" href="#">Settings </a>
                    <a class="list-group-item" href="#"> My Selling Items </a>
                    <a class="list-group-item" href="#"> Received orders </a>
                </ul>
            </aside>

            <main class="col-md-9">
                <article class="card mb-3">
                    <div class="card-body">
                        <p class="widget-title">Datele contului</p>
                        <figure class="icontext">
                            <div class="icon">
                                <img class="rounded-circle img-sm border" src="images/avatars/avatar3.jpg">
                            </div>
                            <div class="text">
                                <strong>
                                    @if(Auth::user()->sex == 1)
                                    Dl.
                                    @else
                                    Mrs.
                                    @endif
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </strong>
                                <br>
                                {{ Auth::user()->email}}
                                <br> 
                                <a href="#">Edit</a>
                            </div>
                        </figure>
                        <hr>
                        <p>
                            <i class="fa fa-map-marker text-muted"></i> &nbsp; My address:  
                            <br>
                            Tashkent city, Street name, Building 123, House 321 &nbsp; 
                            <a href="#" class="btn-link"> Edit</a>
                        </p>

                        <article class="card-group">
                            <figure class="card bg">
                                <div class="p-3">
                                     <h5 class="card-title">0</h5>
                                    <span>Orders</span>
                                </div>
                            </figure>
                            <figure class="card bg">
                                <div class="p-3">
                                     <h5 class="card-title">0</h5>
                                    <span>Wishlists</span>
                                </div>
                            </figure>
                            <figure class="card bg">
                                <div class="p-3">
                                     <h5 class="card-title">0</h5>
                                    <span>Awaiting delivery</span>
                                </div>
                            </figure>
                            <figure class="card bg">
                                <div class="p-3">
                                     <h5 class="card-title">0</h5>
                                    <span>Delivered items</span>
                                </div>
                            </figure>
                        </article>
                    </div>
                </article>
            </main>
        </div>
    </div>
</section>
@endsection