<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
            
      @if (Route::has('login'))
                
        @auth
          <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="/">Home</a>
          </li>
          <li @if($current=="produtos") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="/veiculos">Administrador</a>
          </li>
          <li @if($current=="categorias") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="/cliente">Cliente</a>
          </li>
        @else
          <li @if($current=="home") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('login') }}">Entre</a>
          </li>
          
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('register') }}">Cadastre-se</a>
          </li>
        @endauth
                
      @endif

      

    </ul>

  </div>
</nav>