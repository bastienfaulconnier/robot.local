     <nav>
  <div class="nav-wrapper">
    <a href="\" class="brand-logo">RobotZ</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
   <ul class="right hide-on-med-and-down">
            <li class="{{$current == 'home'? 'active' : 'no-active'}}" >
                <a  href="{{route('home')}}">Accueil</a>
            </li>
            @forelse($categories as $category)
                <li class="{{$current == $category->id? 'active' : 'no-active'}}">
                    <a href="{{url('category', $category->id)}}">{{$category->title}} </a>
                </li>
            @empty
                <li>Aucune catégorie</li>
            @endforelse
        </ul>
    <ul class="side-nav" id="mobile-demo">
      <li><a href="sass.html">Sass</a></li>
      <li><a href="badges.html">Components</a></li>
      <li><a href="collapsible.html">Javascript</a></li>
      <li><a href="mobile.html">Mobile</a></li>
    </ul>
  </div>
</nav>