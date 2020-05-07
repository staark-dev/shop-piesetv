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
                    <a class="list-group-item @yield('page-profile')" href="{{ route('user.profile') }}">Informatii generale</a>
                    <a class="list-group-item @yield('page-orders')" href="{{ route('user.orders') }}">Istoricul comenzilor mele</a>
                    <a class="list-group-item @yield('page-wishlist')" href="{{ route('user.wishlist') }}">Produse favorite</a>
                    <a class="list-group-item @yield('page-retur')" href="{{ route('user.retur') }}">Retur si Banii inapoi</a>
                    <a class="list-group-item @yield('page')" href="{{ route('user.settings') }}">Setari cont</a>
                    @if(Auth::user()->role_id == 3)
                    <a class="list-group-item @yield('page')" href="{{ route('user.seller') }}">Produse vandute de mine.</a>
                    @endif
                    <a class="list-group-item @yield('page')" href="{{ route('user.delivery') }}">Comenzii primite</a>
                </ul>
            </aside>

            <main class="col-md-9">
                @yield('user.content')
            </main>
        </div>
    </div>
</section>
@endsection
