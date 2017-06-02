	@extends('layouts.master')

	@section('title', 'Page Title')

	@section('sidebar')
	    @parent

	    <p>This is appended to the master sidebar.</p>
	@endsection

	@section('content')
	@forelse ($robots as $robot)
	<div class="card">
	    <div class="card-image">
	        <img src="{{url('images', $robot->link)}}">
	  <span class="card-title"><a href="{{url('robot', $robot->id)}}">{{ $robot->name }}</a></span>
	    </div>
	    <div class="card-content">
	        <p>{{ substr($robot->description,0, 100)}} <a href="{{url('robot', $robot->id)}}">lire la suite...</a></p>
	    </div>
	     @forelse($robot->tags as $tag)
	     	@if(isset($tagId) && $tagId != $tag->id)
		      <div class="chip"><a href="{{url('tag', $tag->id)}}">{{ $tag->name }}</a></div>
	       @else
	       <div class="chip">{{ $tag->name }}</div>
	      @endif
	      <div class="chip"><a href="{{url('category', $cat->id)}}">{{ $cat->title }}</a></div>
	      @empty
	        <p>No tags</p>
	    @endforelse
	</div>
	@empty
	    <p>Aucun robot trouvé</p>
	@endforelse
	@endsection