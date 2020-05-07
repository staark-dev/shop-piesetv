@extends('users.index')
@section('page-orders', 'active')
@section('user.content')
    @forelse ($orders as $order)
    <article class="card">
        <header class="card-header">
            <strong class="d-inline-block mr-3">Order ID: {{ $order->id }}</strong>
            <span>Order Date: {{ \Carbon\Carbon::parse($order->placed_date)->format('d F Y') }}</span>
        </header>
        <div class="card-body">
            <div class="row"> 
                <div class="col-md-8">
                    <h6 class="text-muted">{{ trans('common.delivery') }}</h6>
                    <p>{{ $user->getfullname() }}<br>
                    Phone +1234567890 Email: myname@pixsellz.com <br>
                    Location: Home number, Building name, Street 123,  Tashkent, UZB <br> 
                    P.O. Box: 100123
                     </p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-muted">{{ trans('common.payment') }}</h6>
                    <span class="text-success">
                        <i class="fab fa-lg fa-cc-visa"></i>
                        Visa  **** 4216  
                    </span>
                    <p>Subtotal: {{ $order->total_price }} RON<br>
                     Shipping fee:  {{ $order->tax }} RON<br> 
                     <span class="b">Total: {{ $order->total_price + $order->tax }} Ron</span>
                    </p>
                </div>
            </div> <!-- row.// -->
        </div> <!-- card-body .// -->
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    @foreach (json_decode($order->products, true) as $key => $product)
                    <tr>
                        <td width="65">
                            <img src="{{ $product[array_keys($product)[0]]['image'] }}" class="img-xs border">
                        </td>
                        <td> 
                            <p class="title mb-0">{{ $product[array_keys($product)[0]]['name'] }}</p>
                            <var class="price text-muted">RON {{ $product[array_keys($product)[0]]['price'] }}</var>
                        </td>
                        <td> Seller <br> Shop PieseTV</td>
                        <td width="250"> <a href="#" class="btn btn-outline-primary">Track order</a> <a href="#" class="btn btn-light"> Details </a> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </article>
    <br>
    @empty
        Nu ai comenzii.
    @endforelse
    {{ $orders->links() }}
@endsection