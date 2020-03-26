@extends('adm.layouts.body')

@section('customcss')
<style>
.hero-widget { text-align: center; padding-top: 20px; padding-bottom: 20px; }
.hero-widget .icon { display: block; font-size: 64px; line-height: 64px; margin-bottom: 10px; text-align: center; }
.hero-widget var { display: block; height: 48x; font-size: 48px; line-height: 48px; font-style: normal; }
.hero-widget label { font-size: 17px; }
.hero-widget .options { margin-top: 10px; }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-3">
        <div class="hero-widget well well-sm">
            <div class="icon">
                <i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="text">
                <var>{{ $users->count() }}</var>
                <label class="text-muted">utilizatori</label>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="hero-widget well well-sm">
            <div class="icon">
                <i class="glyphicon glyphicon-shopping-cart"></i>
            </div>
            <div class="text">
                <var>{{ $products->count() }}</var>
                <label class="text-muted">produse disponibile</label>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="hero-widget well well-sm">
            <div class="icon">
                <i class="glyphicon glyphicon-credit-card"></i>
            </div>
            <div class="text">
                <var>0</var>
                <label class="text-muted">comenzii</label>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="hero-widget well well-sm">
            <div class="icon">
                <i class="glyphicon glyphicon-sort-by-attributes-alt"></i>
            </div>
            <div class="text">
                <var>{{ $totalCat }}</var>
                <label class="text-muted">categorii</label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="content-box-large">
            <div class="panel-heading">
                <div class="panel-title">Produse adaugate recent</div>
                
                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
            </div>
            <div class="panel-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Titlu Produs</th>
                    <th>Categorie / Sub-Categorie</th>
                    <th>Pret</th>
                    <th>Stock Disponibil</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($recentProduct as $product)
                <tr>
                    <td class="active">{{ $product->id }}</td>
                    <td class="active">{{ $product->title }}</td>
                    <td class="active">
                        @if(empty($product->categories))
                        {{ $product->subCategories[0]->name }}
                        @else
                        {{ $product->categories->name }}
                        @endif
                    </td>
                    <td class="active">{{ $product->price }} RON</td>
                    <td class="active">{{ $product->stock }} buc.</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="content-box-large">
            <div class="panel-heading">
                <div class="panel-title">Comenzii noi plasate</div>
                
                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <p>Nu au fost gasite date.</p>
            </div>
        </div>
    </div>
</div>
@endsection