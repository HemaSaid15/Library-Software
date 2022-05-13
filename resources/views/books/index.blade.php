@extends('layout')

@section('title')
    All Books

@endsection


@section('Content')


    @auth
        <h1>Notes : </h1>
        @foreach ( Auth::user()->notes as $note )
            <p>{{ $note->content }}</p>
        @endforeach
        <a href="{{ route('notes.create')}}" class="btn btn-info">Add New Note</a>
    @endauth
    <h1> All Books</h1>
    @auth
        <a class="btn btn-primary" href="{{ route('books.create')}}">Create</a>
    @endauth

    @foreach($books as $book)

    <hr>
    <a href="{{ route('books.show' , $book->id) }}">
        <h3>{{ $book->title}}</h3>
    </a>
    <p>{{ $book->decs}}</p>
    @auth
        <a class="btn btn-danger" href="{{ route('books.delete',$book->id)}}">Delete</a>
    @endauth

    @endforeach


    {{$books->render()}}
@endsection
