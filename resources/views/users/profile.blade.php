@extends('users.index')
@section('page-profile', 'active')
@section('user.content')
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
                <a href="{{ route('user.settings') }}">Edit</a>
            </div>
        </figure>
        <hr>
        <p>
            <i class="fa fa-map-marker text-muted"></i> &nbsp; Adresa mea:  
            <br>
            {{ $user->city }}, {{ $user->judet }} &nbsp; 
            <a href="{{ route('user.settings') }}" class="btn-link"> Edit</a>
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
@endsection