{{-- vérifier que la variable de session existe et la récupérer dans la variable $flash --}}
@if($flash = session('message'))
    <div class="container flash">
        <div class="col s12">{{$flash}}</div>
    </div>
@endif