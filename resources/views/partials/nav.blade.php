  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
           <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
               <a class="navbar-brand" href="/home"><span style="font-size:12pt;">Distribuidora Hermanos Diaz</span></a>
            </div>
           
            <div class="navbar-collapse collapse" style="font-size: 9pt">
                <div class="menu">
                  <ul class="nav nav-tabs" role="tablist">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item" role="presentation">
                                 <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                              <div class="dropright" style="float:left;margin-top:10px">
                              <li role="presentation">  
                                 
                                  <a style="color:#fff;font-size:9pt;" class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user fa-1x"></i> {{ Auth::user()->username }}
                                  </a>

                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-1x"></i>
                                        {{ __('cerrar sesion') }}
                                    </a>
                                
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                  </div>  
                              </li>
                              </div>
                              <li role="presentation"><a href="/home/cliente">Cliente</a></li>
                              <li role="presentation"><a href="/home/factura">Factura</a></li>                      
                    @endguest
                  </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
