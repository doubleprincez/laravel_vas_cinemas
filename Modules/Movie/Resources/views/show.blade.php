@extends('core::layouts.master')
@section('title') @isset($movie) {{ $movie->title }} @endisset @endsection
@section('content')
    <section>
        <div class="jumbotron-fluid">
            <div class="container">
                <h2> {{ __('movie::names.name') }}: {{ $movie->title }} </h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 mx-auto p-2 w-100">
                        @isset($movie->image)
                            <img src="{{ asset($movie->image->url) }}" class="img-thumbnail mx-auto"/>
                        @endisset
                        <h5 class="mt-2"> {{ __('movie::names.name') }}: {{ $movie->title }} </h5>
                        <small>{{ $movie->genre->name }}</small>
                        <p> {{ __('movie::names.release_year') }}
                            : {{ \Carbon\Carbon::create($movie->release_year)->format('d - m - Y') }} </p>
                        <p> {{ __('movie::names.length') }}: {{ $movie->movie_length }} mins </p>
                        <p class="pt-1 text-justify">{{ $movie->description  }}...</p>

                        @isset($movie->cinema)
                            <h5 class="font-weight-bold">{{ __('movie::names.watch') }}</h5>
                            <div class="row">
                                @foreach($movie->cinema as $cinema)
                                    @if($cinema->pivot->start_time)
                                        @php
                                            $format = \Carbon\Carbon::create($cinema->pivot->start_time);
                                                $time = $cinema->pivot->start_time ?$format->format('d M').' by '.$format->format('h:m a'): __('movie::names.coming_soon');  @endphp
                                        <div class="col-sm-4">
                                            <p>{{ $cinema->name }}</p>
                                            <p>
                                                Time: {{ $time }}
                                            </p>
                                            @if($movie->watched===true)
                                                @if(now()->diff($cinema->pivot->start_time) > 1)
                                                    <p>You are about to watch this movie</p>
                                                @else
                                                    <p>You have Watched this Movie</p>
                                                @endif
                                            @endif
                                            <p>
                                            <form action="{{ route('watch') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="cinema_id" value="{{ $cinema->id }}">
                                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                                <input type="hidden" name="start_time"
                                                       value="{{ $cinema->pivot->start_time}}">
                                                <button type="submit" class="btn btn-outline-secondary"> Watch</button>
                                            </form>
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endisset
                    </div>
                    <div class="col-12">
                        <a href="{{ route('movies') }}" class="btn btn-outline-primary"> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
