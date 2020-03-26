<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Admin Panel</title>
        
        <link href="{{ asset('adm/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        
        <link href="{{ asset('adm/css/styles.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @yield('customcss')
    </head>
    <body id="app">
        @include('adm.layouts.partials.header')
        <div class="page-content">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar content-box" style="display: block;">
                        <ul class="nav">
                        <!-- Main menu -->
                        <li class="current"><a href="{{ route('admin.dashboard') }}"><i class="glyphicon glyphicon-home"></i> Prima Pagina</a></li>
                        <li><a href="{{ route('admin.product.index') }}"><i class="glyphicon glyphicon-shopping-cart"></i> Produse</a></li>
                        <li><a href="{{ route('admin.orders.index') }}"><i class="glyphicon glyphicon-credit-card"></i> Comenzii</a></li>
                        <li><a href="{{ route('admin.user.index') }}"><i class="glyphicon glyphicon-user"></i> Utilizatori</a></li>
                        <li><a href="{{ route('admin.cat.index') }}"><i class="glyphicon glyphicon-sort-by-attributes-alt"></i> Categorii</a></li>
                        <li><a href="{{ route('admin.task.index') }}"><i class="glyphicon glyphicon-tasks"></i> Tasks</a></li>
                        <li><a href="{{ route('admin.cart.index') }}"><i class="glyphicon glyphicon-shopping-cart"></i> Setari Cos</a></li>
                        <li><a href="{{ route('admin.mail.index') }}"><i class="glyphicon glyphicon-envelope"></i> Mail</a></li>
                        <li><a href="{{ route('admin.setting.index') }}"><i class="glyphicon glyphicon-wrench"></i> Setari Site</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    @yield('content')
                </div>
            </div>
        </div>

        @include('adm.layouts.partials.footer')

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('adm/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('adm/js/custom.js') }}"></script>
        @yield('scripts')
    </body>
</html>