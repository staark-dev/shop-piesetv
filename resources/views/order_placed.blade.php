@extends('layouts.app')

@section('header-banner')
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Comanda Finalizata</h2>
    </div>
</section>
@endsection

@section('content')

<section class="section-content padding-y" style="min-height:84vh">
    <section class="section-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h5>Va multumim, comanda dvs, va fii procesata in cel mai scurt timp disponibil.</h5>
                    <p>Comanda #{{ $billing_data[0] }} <br>
                        Comanda a fost procesata in sistem, in cel mai scurt timp ve-ti primi un email cu datele comenzii.
                        <br>
                        Detalii despre comanda gasiti aici <u class="text-success">https://upgrade.shop-piesetv.ro/order/hash/{{ $billing_data[1] }}</u>.</p>
                    <p>Va multumim pentru alegerea dvs.</p>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection