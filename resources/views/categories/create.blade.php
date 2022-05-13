@extends('layout')

@section('title')
    Create New Category
@endsection


@section('Content')
    @include('inc.errors')
    <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Category Name </label>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name')}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
