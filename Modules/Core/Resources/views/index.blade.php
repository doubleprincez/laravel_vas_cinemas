@extends('core::layouts.master')
@section('title') Home @endsection
@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('core.name') !!}
    </p>
    // Show all movies and if user is logged in you can watch
    book
    @isset($cinemas)
        @dd($cinemas)
    @endisset

@endsection
