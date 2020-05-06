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
        <h2 class="title-page">Contul meu</h2>
    </div> <!-- container //  -->
</section>

<section class="section-content padding-y bg-white">
    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <ul class="list-group">
                    <a class="list-group-item active" href="{{ route('user.profile') }}">Informatii generale</a>
                    <a class="list-group-item" href="{{ route('user.orders') }}">Comenzile mele</a>
                    <a class="list-group-item" href="{{ route('user.wishlist') }}">Produse favorite</a>
                    <a class="list-group-item" href="{{ route('user.retur') }}">Retur si Banii inapoi</a>
                    <a class="list-group-item" href="{{ route('user.settings') }}">Setari cont</a>
                    <a class="list-group-item" href="{{ route('user.seller') }}">Produse vandute de mine.</a>
                    <a class="list-group-item" href="{{ route('user.delivery') }}">Comenzii primite</a>
                </ul>
            </aside>

            <main class="col-md-9">
                <article class="card mb-3">
                    <div class="card-body">
                        <p class="widget-title">Datele contului</p>
                        <figure class="icontext">
                            <div class="icon">
                                <img class="rounded-circle img-sm border" src="{{ Storage::disk('public')->url(Auth::user()->avatar) }}">
                            </div>
                            <div class="text">
                                <strong>
                                    
                                    @if(Auth::user()->sex == 1) Dl. @else Mrs. @endif
                                    {{ $user::getfullname() }}
                                </strong>
                                <br>
                                {{ Auth::user()->email}}
                                <br> 
                                <a href="#">Edit</a>
                            </div>
                        </figure>
                        <hr>
                        <p>
                            <i class="fa fa-map-marker text-muted"></i> &nbsp; Adresa mea:  
                            <br>
                            {{ $user->addresses[0]->city }}, {{ $user->addresses[0]->address1 }} {{ $user->addresses[0]->address2 }} &nbsp; 
                            <a href="#" class="btn-link"> Edit</a>
                        </p>

                        <article class="card-group">
                            <figure class="card bg">
                                <div class="p-3">
                                     <h5 class="card-title">{{ $user->userOrders() }}</h5>
                                    <span>Comenzii</span>
                                </div>
                            </figure>
                            <figure class="card bg">
                                <div class="p-3">
                                     <h5 class="card-title">0</h5>
                                    <span>Produse Favorite</span>
                                </div>
                            </figure>
                            <figure class="card bg">
                                <div class="p-3">
                                     <h5 class="card-title">{{ $user->userOrdersAwait() }}</h5>
                                    <span>Produse in asteptare</span>
                                </div>
                            </figure>
                            <figure class="card bg">
                                <div class="p-3">
                                     <h5 class="card-title">{{ $user->userOrdersDelivery() }}</h5>
                                    <span>Produse livrate</span>
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
