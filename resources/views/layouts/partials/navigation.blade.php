<nav class="navbar navbar-main navbar-expand-lg navbar-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link pl-0" data-toggle="dropdown" href="#"><strong> <i class="fa fa-bars" style="color:black;font-weight:bold"></i></strong> &nbsp;Toate Categoriile</a>
                    <div class="dropdown-menu">
                        @foreach ($allCat as $item)
                        <a class="dropdown-item" href="{{ route('cat.view', ['slug' => $item->slug]) }}">{{ $item->name }}</a>

                        @if($loop->iteration == 2)
                        <div class="dropdown-divider"></div>
                        @endif
                        
                        @endforeach
                    </div>
                </li>
                @foreach ($headCat as $item)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cat.view', ['slug'=> $item->slug]) }}">{{ $item->name }}</a>
                </li>
                @endforeach
            </ul>
        </div> <!-- collapse .// -->
    </div> <!-- container .// -->
</nav>