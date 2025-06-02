<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="con-name">
            <a class="navbar-brand custom-logo" href="{{ url('/') }}">
                {{ config('app.name', 'Bloommonie') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <i class='bx bx-menu-wider'></i> 
            </button>
        </div>

        <div class="custom-middle">
            <ul class="custom-menu">
                <li class="custom-item"><a class="custom-link" href="{{ url('/#business') }}">Business Types</a></li>
                <li class="custom-item"><a class="custom-link" href="{{ url('/support') }}">24/7 Support</a></li>
                <li class="custom-item"><a class="custom-link" href="{{ url('/pricing') }}">Pricing</a></li>
                <li class="custom-item"><a class="custom-link" href="{{ url('/features') }}">Features</a></li>
            </ul>
        </div>
    
        <!-- Right Navigation -->
        <ul class="custom-right">
            @guest
                @if (Route::has('login'))
                    <li class="custom-item">
                        <a class="custom-link login-button custom-button" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
    
                @if (Route::has('register'))
                    <li class="custom-item">
                        <a class="custom-link signup-button custom-button" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
                @else
                <li class="nav-item dropdown drop-nav">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
    </div>
</nav>



