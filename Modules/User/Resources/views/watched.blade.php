@extends('core::layouts.master')
@section('title') Watched @endsection
@section('content')
    <section>
        <div class="jumbotron-fluid">
            <div class="container mb-5">
                <h2> {{ __('user::names.name') }} </h2>
            </div>
            <div class="container">
                @isset($watched)
                    <div class="row">
                        @foreach($watched as $k => $cinema)
                            <div class="col-12 my-5">
                                <h4 class="font-weight-bolder text-uppercase">{{ $k }}</h4>
                                <div class="row align-items-start">
                                    @foreach($cinema as $item)
                                        <div class="col-sm-1 col-md-4 col-xl-3 card shadow-lg ">
                                            <div class="container-fluid p-2">
                                                @isset($item->movie->image)
                                                    <img src="{{ asset($item->movie->image->url) }}"
                                                         class="img-thumbnail mx-auto"/>
                                                @endisset
                                                <h4 class="mt-2"> {{ __('names.name') }}
                                                    : {{ $item->movie->title }} </h4>
                                                <small>{{ $item->movie->genre->name }}</small>
                                                <p> {{ __('names.release_year') }}
                                                    : {{ \Carbon\Carbon::create($item->movie->release_year)->format('d-m-Y') }} </p>
                                                <p> {{ __('names.length') }}: {{ $item->movie->movie_length }} mins </p>
                                                <p class="pt-1">{{ substr($item->movie->description,0,100) }}...</p>
                                                @php
                                                    $format = \Carbon\Carbon::create($item->start_time);
                                                    if($format->isPast()){
                                                        $text = __('names.watched_on');
                                                    }else{
                                                        $text = __('names.will_watch_on');
                                                    }
                                                @endphp
                                                <p>{{ $text }} {{ $format->format('d-m-Y h:m a') }}</p>
                                                <a href="{{ route('movie.show',['id'=>$item->movie->id]) }}"
                                                   class="btn btn-outline-info btn-sm">
                                                    {{ __('names.read_more') }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
    </section>

@endsection
