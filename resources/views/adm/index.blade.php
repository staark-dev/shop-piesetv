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
                <div class="panel-title">Ultimele vizite pe site</div>
            </div>

            <div class="panel-body table-responsive">
                <table class="table table-stripe">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Utilizator</td>
                            <td>Browser</td>
                            <td>Dispozitiv</td>
                            <td>IP</td>
                            <td>Ultima activitate</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php $id = 1; @endphp
                        @foreach ($visite as $item)
                        @php 
                            $agent = App\Http\Controllers\Admin\DashboardController::get_browser($item->user_agent); 
                            //$agent = App\Http\Controllers\Admin\DashboardController::get_browser_name($item->user_agent);
                            $lastUpdate = date('Y-m-d H:i:s', $item->last_activity); 
                            $minute = date_diff(new \DateTime($lastUpdate), new \DateTime())->i; // Get Minutes of date diff
                            $ore = date_diff(new \DateTime($lastUpdate), new \DateTime())->h; // Get Minutes of date diff
                        @endphp

                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>@if ($item->user_id != null)
                                <strong style="color: red; ">{{ \App\User::getname($item->user_id) }}</strong>
                            @else {{ $agent['bot'] }} @endif</td>
                            <td>
                                {{ $agent['browser'] }}
                            </td>
                            <td>
                                @if ($agent['mobile'] != 'Unknown')
                                {{ $agent['mobile'] }}
                                @else
                                Desktop ({{ $agent['platform'] }})
                                @endif
                            </td>
                            <td>{{ $item->ip_address }}</td>
                            <td>
                                @if($minute > 0)
                                {{ date_diff(new \DateTime($lastUpdate), new \DateTime())->format("acum %i minute si %s secunde") }}
                                @elseif($ore > 0)
                                {{ date_diff(new \DateTime($lastUpdate), new \DateTime())->format("acum %h ore, %i minute si %s secunde") }}
                                @else
                                {{ date_diff(new \DateTime($lastUpdate), new \DateTime())->format("acum %s secunde") }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $visite->links() }}
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
            <div class="panel-body table-responsive">
                @if(empty($orders))
                <p>Nu au fost gasite date.</p>
                @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order Number #</th>
                            <th>Order Author</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Tracker</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody> @foreach ($orders as $order)
                        <tr>
                            <td class="active">#{{ str_pad($order->id, 8, "0", STR_PAD_LEFT) }}</td>
                            <td class="active">{{ \App\User::getfullname($order->user_id) }}</td>
                            <td class="active">{{ $order->total_price + $order->tax }} Lei</td>
                            <td class="active">{!! ($order->status == true) ? '<span class="text-success">Procesata</span>' : '<span class="text-danger">Anulata</span>' !!}</td>
                            <td class="active">{{ ($order->tracker == 1) ? 'In curs de verificare' : 'Uncknow' }}</td>
                            <td class="active">
                                <a href="#" class="view"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;
                                <a href="#" class="edit"><span class="glyphicon glyphicon-cog"></span></a>
                            </td>
                        </tr>
                    @endforeach</tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

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
</div>
@endsection