@extends('layouts.app')

@section('header-banner')
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Cos de cumpărături</h2>
    </div>
</section>
@endsection

@section('content')
@php
$totalPrice = 0;
@endphp
<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            <main class="col-md-9">
                <div class="card">
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
                            @if($cart->count() > 0)
                            @foreach (json_decode($cart[0]->product_info) as $key => $value)
                                @foreach ($value as $item)
                                @php
                                    $totalPrice += $item->price;
                                @endphp
                                <tr>
                                    <td>
                                        <figure class="itemside">
                                            <div class="aside"><img src="{{ Storage::disk('public')->url('images/items/' . $item->image) }}" class="img-sm"></div>
                                            <figcaption class="info">
                                                <a href="#" class="title text-dark">{{ $item->name }}</a>
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
                                        <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip"> <i class="fa fa-heart"></i></a> 
                                        <a href="" class="btn btn-light"> Remove</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="card-body border-top">
                        <a href="#" class="btn btn-primary float-md-right">Plaseaza comanda <i class="fa fa-chevron-right"></i> </a>
                        <a href="{{ route('home') }}" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continua cumparaturile</a>
                    </div>
                </div>
            </main>

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
        </div>
    </div>
</section>
@endsection