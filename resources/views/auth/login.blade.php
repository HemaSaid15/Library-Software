@extends('layout')

@section('title')
    New Login
@endsection


@section('Content')
    @include('inc.errors')
    <form method="POST" action="{{ route('auth.handleLogin') }}" >

        @csrf


        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User E-mail </label>
            <input type="text" name="email" class="form-control" placeholder="Enter E-mail" value="{{ old('email')}}">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Password </label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password" value="{{ old('password')}}">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
