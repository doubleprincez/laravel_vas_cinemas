@extends('core::layouts.master')
@section('title') CINEMAS @endsection
@section('content')
    <section class="container-md">
        @isset($town)
            <h3>{{ __('cinema::names.list_of_cinemas') }} {{ $town }}</h3>
        @else
            <h3>List of Cinemas</h3>
        @endisset
        @isset($cinemas)
            <div class="row align-items-center">
                @foreach($cinemas as $cinema)
                    <div class="col-sm-1 col-md-4 col-xl-3 m-lg-5">
                        @isset($cinema->image)
                            <img src="{{ asset($cinema->image->url) }}" class="img-thumbnail mx-auto"/>
                        @endisset
                        <h4 class="mt-2"> {{ __('cinema::names.name') }}: {{ $cinema->name }} </h4>
                        <p> {{ __('cinema::names.address') }}: {{ $cinema->address }} </p>
                        <p> {{ __('cinema::names.phone') }}: {{ $cinema->phone }} </p>
                        <p>{{ $cinema->other_details }}</p>
                        <a href="{{ route('cinema.show',['id'=>$cinema->id]) }}"
                           class="btn btn-outline-info"> {{ __('cinema::names.visit') }}</a>
                    </div>
                @endforeach
                <div class="container">
                    {{ $cinemas->appends(request()->except('page'))->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        @endisset
    </section>

@endsection
