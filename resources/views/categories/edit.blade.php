@extends('layout')

@section('title')
    Update Category Number {{ $category->id }}
@endsection


@section('Content')
    @include('inc.errors')
    <form method="POST" action="{{ route("categories.update" , $category->id)}}" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Category Name </label>
            <input type="text" name="name" class="form-control" value="{{old('name') ?? $category->name}}" placeholder="Enter Name">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
