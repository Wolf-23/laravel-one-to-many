@extends('layouts.app')

@section('content')
    <div class="container">
      {{-- <div class="d-flex justify-content-between">
        <a href="{{route('admin.posts.create')}}" class="btn btn-success mb-3">Crea Nuovo Post</a>
        <div>
          <a href="{{route('admin.posts.simone')}}" class="btn btn-primary mb-3">Post Simone</a>
          <a href="{{route('admin.posts.alessio')}}" class="btn btn-primary mb-3">Post Alessio</a>
          <a href="{{route('admin.posts.jacopo')}}" class="btn btn-primary mb-3">Post Jacopo</a>
        </div>
      </div> --}}
        <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Numero Post</th>
                <th scope="col" class="text-center">Gestisci</th>
              </tr>
            </thead>
            <tbody class="table-light text-dark">
                @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td>{{count($category->posts)}}</td>
                    <td class="text-center">
                        <a href="{{route('admin.categories.show', ['category' => $category->id])}}" class="btn btn-success">Vedi</a>
                    </td> 
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection