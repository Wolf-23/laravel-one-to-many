@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('admin.posts.index')}}" class="btn btn-success mb-3">Vedi tutti i post</a>
        <div class="card" style="width: 30rem;">
            <img src="{{$post->media}}" class="card-img-top" alt="{{$post->title}}">
            <div class="card-body">
              <h2 class="card-title">{{$post->title}}</h2>
              <h5 class="card-title">Scritto da {{$post->author}}</h5>
              <p class="card-text">{{$post->content}}</p>
              <div class="text-center">
                <a href="{{route('admin.posts.edit', ['post' => $post->id])}}"  class="btn btn-warning">Modifica</a>
              </div>
            </div>
          </div>
    </div>
@endsection