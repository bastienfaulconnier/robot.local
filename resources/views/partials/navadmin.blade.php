<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">RobotZ</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li >
                <a  href="{{route('home')}}">Accueil</a>
            </li>
            @if(auth()->check()) {{-- test si vous êtes connecté --}}
            	<li>
                	<a href="{{url('dashboard')}}">Profil</a>
                </li>
                <li>
                	<a href="{{route('logout')}}">Se déconnecter</a>
                </li>
                @else
                <li>
                	<a href="{{route('login')}}">Login</a>
                </li>
        	@endif
        </ul>
    </div>
  </nav>  