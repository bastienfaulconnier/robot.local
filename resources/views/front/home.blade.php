@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
@forelse ($robots as $robot)
<div class="row">
        <div class="col s8 offset-s2">
            <div class="card hoverable">
                <div class="card-image">
                    <img src="{{url('images', $robot->link)}}">
              <span class="card-title"><a href="{{url('robot', $robot->id)}}">{{ $robot->name }}</a></span>
                </div>
                <div class="card-content">
                    <p>{{ substr($robot->description,0, 100)}} <a href="{{url('robot', $robot->id)}}">lire la suite...</a></p>
                    <p>Batterie : {{$robot->power}} %</p>
                    <p>RAM : {{$robot->type}} </p>
                </div>
                @forelse($robot->tags as $tag)
                  <div class="chip"><a href="{{url('tag', $tag->id)}}">{{ $tag->name }}</a></div>
                  @empty
                    <p>No tags</p>
                @endforelse
            </div>
        </div>
    </div>

@empty
    <p>Aucun robot trouvé</p>
@endforelse
@endsection