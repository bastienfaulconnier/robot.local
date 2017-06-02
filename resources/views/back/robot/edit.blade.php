@extends('layouts.admin')
@section('content')

 @if (count($errors) > 0)
    <div class="alert alert-danger">
        <p>Une erreure est survenue dans le formulaire</p>
        <ul>
            @foreach($errors->all() as $message)
            <li>{{$message}}</li>
            @endforeach
        </ul>
    </div>
 @endif
<form class="row" method="post" action="{{route('robot.update', $robot->id)}}" enctype="multipart/form-data">
            {{csrf_field()}} {{-- Token de protection formulaire CSRF (??) --}}
            {{ method_field('PUT') }}
            <div class="col s6 ">
                <div class='input-field'>
                    <input id="name" name="name" type="text" value="{{$robot->name}}">
                    <label for="name">Name</label>
                </div>
                <div class='input-field'>
                    <textarea id="description" name="description" class="materialize-textarea">{{$robot->description}}</textarea>
                    <label for="description">Description</label>
                </div>
                        @foreach($tags as $id => $name)

                            <p style="display: inline-block">
                            <input {{ $robot->isTag($id)? 'checked' : '' }} value="{{$id}}" name="tags[]" type="checkbox" id="tag{{$id}}" />
                            <label for="tag{{$id}}">{{$name}}</label>
                            </p>
                        @endforeach
            </div>
            <div class="col s6  ">
                <div class='input-field'>
                    <select id="category" name="category">
                        <option value="" disabled selected>No category</option>
                        @foreach($categories as $id => $title)
                             <option {{ selected_fields($id,  $robot->category_id, 'selected') }}  value="{{$id}}">{{$title}}</option>
                        @endforeach
                    </select>
                    <label>Choose a category</label>
                </div>
                <div class='input-field'>
                    <select id="status" name="status">
                        <option {{ $robot->status == 'published' ? 'checked' : ''  }} type="checkbox" name="published_at" value="published"" selected>Published</option>
                        <option {{ $robot->status == 'unpublished' ? 'checked' : ''  }} value="unpublished">Unpublished</option>
                    </select>
                    <label>Status</label>
                </div>


                <div class="file-field input-field">
                    <div class="waves-effect waves-light btn deep-orange darken-2">
                        <span>Parcourir</span>
                        <input type="file" name="link">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload a picture for your robot" value="{{$robot->link}}">
                    </div>
                </div>
            </div>
            <div class='col s12 center-align'>
                <button type="submit" class="waves-effect waves-light btn deep-orange darken-2">Envoyer<i class="material-icons right">send</i></button>
            </div>
            
        </form>

@endsection