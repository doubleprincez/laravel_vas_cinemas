@extends('core::layouts.master')
@section('title') @isset($cinema) {{ $cinema->name }} @endisset @endsection
@section('content')
    <section class="container-md">
        <div class="container my-5">
            <a href="{{ url()->previous()  }}" class="btn btn-outline-primary"> {{ __('cinema::names.back') }}</a>
        </div>
        @if($cinema)
            <div class="container-md">
                <div class="card">
                    <div class="flex flex-grow-1 p-5 my-5">
                        @isset($cinema->image)
                            <img src="{{ asset($cinema->image->url) }}" class="img-thumbnail mx-auto"/>
                        @endisset
                        <h4 class="mt-2"> {{ __('cinema::names.name') }}: {{ $cinema->name }} </h4>
                        <p> {{ __('cinema::names.address') }}: {{ $cinema->address }} </p>
                        <p> {{ __('cinema::names.phone') }}: {{ $cinema->phone }} </p>
                        <p>{{ $cinema->other_details }}</p>
                    </div>
                </div>
            </div>
        @endif

        @isset($movies)
            <div class="flex mt-4">
                <h3 class="text-danger font-weight-bold text-lg-center">{!! __('cinema::names.movies') !!} </h3>
                <div class="row align-items-center">
                    @foreach($movies as $movie)
                        <div class="card shadow-lg col-sm-1 col-md-4 col-xl-3  m-4">
                            <div class="container-fluid p-2">
                                @isset($movie->image)
                                    <img src="{{ asset($movie->image->url) }}" class="img-thumbnail mx-auto"/>
                                @endisset
                                <h4 class="mt-2"> {{ __('cinema::names.name') }}: {{ $movie->title }} </h4>
                                <small>{{ $movie->genre->name }}</small>
                                <p> {{ __('cinema::names.release_year') }}
                                    : {{ \Carbon\Carbon::create($movie->release_year)->format('d-m-Y') }} </p>
                                <p> {{ __('cinema::names.length') }}: {{ $movie->movie_length }} mins </p>
                                <p class="pt-1">{{ substr($movie->description,0,100) }}...</p>
                                <a href="{{ route('movie.show',['id'=>$movie->id]) }}"
                                   class="btn btn-outline-info btn-sm">
                                    {{ __('cinema::names.read_more') }}</a>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="container">
                    {{ $movies->appends(request()->except('page'))->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>

        @endisset
    </section>
@endsection
