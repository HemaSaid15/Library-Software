@extends('layout')

@section('title')
    All Categories

@endsection


@section('Content')
    <h1> All Categories</h1>
    @auth
        <a class="btn btn-primary" href="{{ route('categories.create')}}">Create</a>
    @endauth

    @foreach($categories as $category)

    <hr>
    <a href="{{ route('categories.show' , $category->id) }}">
        <h3>{{ $category->name}}</h3>
    </a>
    @auth
        <a class="btn btn-danger" href="{{ route('categories.delete',$category->id)}}">Delete</a>
    @endauth

    @endforeach


    {{$categories->render()}}
@endsection
