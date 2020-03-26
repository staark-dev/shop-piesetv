<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="{{ asset('adm/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- styles -->
        <link href="{{ asset('adm/css/styles.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            @yield('customcss')
        </style>
    </head>
    <body>
        @include('adm.layouts.partials.header')
        <div class="page-content">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar content-box" style="display: block;">
                        <ul class="nav">
                        <!-- Main menu -->
                        <li class="current"><a href="{{ route('admin.dashboard') }}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                        <li><a href="{{ route('admin.product.index') }}"><i class="glyphicon glyphicon-shopping-cart"></i> Products</a></li>
                        <li><a href="{{ route('admin.orders.index') }}"><i class="glyphicon glyphicon-credit-card"></i> Orders</a></li>
                        <li><a href="{{ route('admin.user.index') }}"><i class="glyphicon glyphicon-user"></i> Custommers</a></li>
                        <li><a href="{{ route('admin.cat.index') }}"><i class="glyphicon glyphicon-sort-by-attributes-alt"></i> Categories</a></li>
                        <li><a href="{{ route('admin.task.index') }}"><i class="glyphicon glyphicon-tasks"></i> Tasks</a></li>
                        <li><a href="{{ route('admin.cart.index') }}"><i class="glyphicon glyphicon-shopping-cart"></i> Cart</a></li>
                        <li><a href="{{ route('admin.mail.index') }}"><i class="glyphicon glyphicon-envelope"></i> Mail</a></li>
                        <li><a href="{{ route('admin.setting.index') }}"><i class="glyphicon glyphicon-wrench"></i> Settings</a></li>
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
    </body>
</html>