@extends('layouts.app')

@section('navigation')
    @include('layouts.partials.navigation')
@endsection

@section('header-banner')
<section class="section-pagetop bg">
    <div class="container">
        <h2 class="title-page">Livrare & Metode de plata</h2>
    </div>
</section>
@endsection

@section('content')
<section class="section-content padding-y" style="min-height:84vh">
    <section class="section-content">
        <div class="container">
            <header class="section-heading">
                <h3 class="section-title">Informatii despre plasare comenzi</h3>
            </header>
        </div>
    </section>

    <section class="section-content">
        <div class="container">
            <header class="section-heading">
                <h3 class="section-title">Metode de plata</h3>
            </header>
        </div>
    </section>

    <section class="section-content">
        <div class="container">
            <header class="section-heading">
                <h3 class="section-title">Livrarea Produselor</h3>
            </header>
        </div>
    </section>
</section>
@endsection