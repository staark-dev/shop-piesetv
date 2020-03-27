<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
	            <!-- Logo -->
	            <div class="logo">
	                <h1><a href="{{ route('admin.dashboard') }}">{{ config('app.name') }}</a></h1>
	            </div>
            </div>

            <div class="col-md-2">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav navbar-right" style="width: 200px;">
                            <li class="dropdown">
                                <a target="_blank" href="{{ route('home') }}">Vezi Site</a>
                            </li>
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="caret"></b></a>
                            <ul class="dropdown-menu animated fadeInUp">
                                <li><a href="{{ route('admin.user.edit', ['user' => Auth::user()->id]) . '?section=profile' }}">Profil Meu</a></li>
                                <li><a href="#">Deconectare</a></li>
                            </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
	        </div>
	     </div>
	</div>