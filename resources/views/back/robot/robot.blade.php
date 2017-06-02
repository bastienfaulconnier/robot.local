@extends('layouts.admin') 
@section('content')

<table class="striped centered">
        <thead>
              <th>Statut</th>
              <th>Nom</th>
              <th>Categorie</th>
              <th>Tags</th>
              <th>Editer</th>
              <th>Supprimer</th>
        </thead>
        <tbody>
        @foreach ($robots as $robot)
        <tr>
            <td>{{$robot->status}}</td>
            <td>{{$robot->name}}</td>
            <td>@if($robot->category) {{$robot->category->title}} @endif</td>
            <td>
            @foreach ($robot->tags as $tag)
            {{$tag->name}}
            @endforeach </td>

            @can('update', $robot)
            <td><a href="{{route('robot.edit', $robot->id)}}"><i class="material-icons">mode_edit</i></a></td>
            @endcan

            @can('delete', $robot)
            <form method="post" action="{{route('robot.destroy', $robot->id)}}">
             {{csrf_field()}} {{-- Token de protection formulaire CSRF (??) --}}
            {{ method_field('DELETE') }}
            <td><button type="submit"><i class="material-icons">delete</i></button></td>
            @endcan

            </form>

          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="center-align">
      {{$robots->links()}}
      </div>

      <div class="right-align">
      <a href="{{route('robot.create')}}" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
      <br/><br/>
</div>
@endsection

@section('scripts')
  @parent

@endsection

