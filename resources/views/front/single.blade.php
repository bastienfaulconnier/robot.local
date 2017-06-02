@extends('layouts.master')

@section('title', $title)

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
   @if(!empty($robot))
  
  <h2>{{$robot->name}}</h2>
  <div class="content">
    @if($robot->link != null)
    <img class="responsive-img" src="{{url('images', $robot->link)}}">
    @endif
    {{ $robot->description }}

    @forelse($robot->tags as $tag)
      <div class="chip"><a href="{{url('tag', $tag->id)}}">{{ $tag->name }}</a></div>
      @empty
        <p>No tags</p>
    @endforelse
  </div>
  
   @endif
  
@endsection