@extends('layouts.app')
@section('title') MOVIES @endsection
@section('content')
    <div class="container jumbotron-fluid">
        @isset($movies)
            <div class="flex mt-4">
                <h3 class="text-danger font-weight-bold text-lg-center">{!! __('names.movies') !!} </h3>
                <div class="row align-items-center">
                    @foreach($movies as $movie)
                        <div class="card shadow-lg col-sm-1 col-md-4 col-xl-3  m-4">
                            <div class="container-fluid p-2">
                                @isset($movie->image)
                                    <img src="{{ asset($movie->image->url) }}" class="img-thumbnail mx-auto"/>
                                @endisset
                                <h4 class="mt-2"> {{ __('names.name') }}: {{ $movie->title }} </h4>
                                <small>{{ $movie->genre->name }}</small>
                                <p> {{ __('names.release_year') }}
                                    : {{ \Carbon\Carbon::create($movie->release_year)->format('d-m-Y') }} </p>
                                <p> {{ __('names.length') }}: {{ $movie->movie_length }} mins </p>
                                <p class="pt-1">{{ substr($movie->description,0,100) }}...</p>
                                <a href="{{ route('movie.show',['id'=>$movie->id]) }}"
                                   class="btn btn-outline-info btn-sm">
                                    {{ __('names.read_more') }}</a>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="container">
                    {{ $movies->appends(request()->except('page'))->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>

        @endisset
    </div>
@endsection
