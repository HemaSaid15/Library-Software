@extends('layout')

@section('title')
    Create New Note
@endsection


@section('Content')
    @include('inc.errors')
    <form method="POST" action="{{ route('notes.store') }}" >

        <!-- csrf attack stands for cross site request forgery that prevent any attack from other
                websites on your site and make more security to your data   -->

        @csrf


        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea name="content" class="form-control"  rows="3" placeholder="Description">{{ old('content') }}</textarea>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
