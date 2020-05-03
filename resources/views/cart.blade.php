@extends('layouts.app')

@section('add_style')
.table-shopping-cart td.text-right form {
    float: left;
    margin-right: 10px;
}

.table-shopping-cart .price {
    min-width: 100px;
}
@endsection

@section('header-banner')
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Cos de cumpărături</h2>
    </div>
</section>
@endsection

@section('content')
@php $totalPrice = 0; @endphp
<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            
            <main class="@if( ($cart->user_id != null || $cart->user != null) && count(json_decode($cart->product_info, true)) >= 1 )col-md-9 @else col-md-12 @endif">
                <div class="card">
                    @if( ($cart->user_id != null || $cart->user != null) && count(json_decode($cart->product_info, true)) >= 1 )
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Produs</th>
                                <th scope="col" width="120">Cantitate</th>
                                <th scope="col" width="120">Pret</th>
                                <th scope="col" class="text-right" width="200"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( ($cart->user_id != null || $cart->user != null) && count(json_decode($cart->product_info, true)) >= 1 )
                            @foreach (json_decode($cart->product_info) as $key => $value)
                                @foreach ($value as $keys => $item)
                                @php
                                    $totalPrice += $item->price;
                                @endphp
                                <tr>
                                    <td>
                                        <figure class="itemside">
                                            <div class="aside"><img src="{{ Storage::disk('public')->url('images/items/' . $item->image) }}" class="img-sm"></div>
                                            <figcaption class="info">
                                                <a href="{{ route('product.view', ['slug' => $item->url ]) }}" class="title text-dark">{{ $item->name }}</a>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td>
                                        <select class="form-control">
                                            <option>1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="price-wrap"> 
                                            <var class="price">{{ $item->price }} Ron</var>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        {{ Form::open(array('', 'method' => 'POST')) }}
                                        {!! Form::submit('&hearts;', array('class' => 'btn btn-light', 'data-toggle' => "tooltip", 'data-placement' => "top", 'title' => "Salveaza pentru mai tarziu")) !!}
                                        {{ Form::close() }}

                                        {{ Form::open(array('route' => array('cart.delete', 'id' => $keys), 'method' => 'DELETE')) }}
                                        
                                        {{ Form::submit('Sterge', array('class' => 'btn btn-light', 'data-toggle' => "tooltip", 'data-placement' => "top", 'title' => "Sterge acest produs din cos")) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    @else
                    <p class="card-body">Cosul dumneavoastra de cumparaturi este gol.<br>Pentru a adauga produse in cos va rugam sa va intoarceti in magazin si selectati <u>Adauga in cos</u> in pagina de produs.</p>
                    @endif
                    <div class="card-body border-top">
                        @if( ($cart->user_id != null || $cart->user != null) && count(json_decode($cart->product_info, true)) >= 1 )<a href="{{ route('cart.order.place') }}" class="btn btn-primary float-md-right">Plaseaza comanda <i class="fa fa-chevron-right"></i> </a>@endif
                        <a href="{{ route('home') }}" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continua cumparaturile</a>
                    </div>
                </div>
            </main>

            @if( ($cart->user_id != null || $cart->user != null) && count(json_decode($cart->product_info, true)) >= 1 )
            <aside class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body" style="display: none">
                        <form>
                            <div class="form-group">
                                <label>Ai un cupon?</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="" placeholder="Coupon code">
                                    <span class="input-group-append"> 
                                        <button class="btn btn-primary">Aplica</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Total price:</dt>
                            <dd class="text-right">@php echo $totalPrice; @endphp Ron</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Discount:</dt>
                            <dd class="text-right">0 Ron</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right  h5"><strong>@php echo $totalPrice; @endphp Ron</strong></dd>
                        </dl>
                    </div>
                </div>
            </aside>
            @endif
        </div>
    </div>
</section>


<section class="section-name bg padding-y">
    <div class="container">
        <h6>Payment and refund policy</h6>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div><!-- container // -->
</section>
@endsection

@section('scripts')
    <script>
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection