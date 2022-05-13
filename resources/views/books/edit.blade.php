@extends('layout')

@section('title')
    Update Book Number {{ $book->id }}
@endsection


@section('Content')
    @include('inc.errors')
    <form method="POST" action="{{ route("books.update" , $book->id)}}" enctype="multipart/form-data">

        <!-- csrf attack stands for cross site request forgery that prevent any attack from other
                websites on your site and make more security to your data   -->

        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Book Name </label>
            <input type="text" name="title" class="form-control" value="{{old('title') ?? $book->title}}" placeholder="Enter Name">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea name="decs" class="form-control"  rows="3" placeholder="Description">{{old('decs') ?? $book->decs}}</textarea>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" type="file" name="img">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
