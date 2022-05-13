
@extends('layout')

@section('Content')
    <h1>Category ID : {{ $category->id }}</h1>

    <h3>{{ $category->name }}</h3>

    <h3> Books : </h3>
    <ul>
        @foreach ($category->books as $book)
            <li>{{ $book->title}}</li>
        @endforeach
    </ul>
    <hr>
    <a href="{{ route('categories.index')}}">  Back</a>
@endsection
