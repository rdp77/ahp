@extends('layouts.calculate')
@section('title', __('My Blogs'))

@section('content')
    <div class="card">
        <div class="card-body">
            {{--            <div class="text-center">--}}
            {{--                <img src="{{ asset('images/'.$article->thumbnail) }}" class="img-fluid img-responsive">--}}
            {{--            </div>--}}
            {{--            <h2 class="mt-4">{{ $article->title }}</h2>--}}
            {{--            <p class="mt-4 mb-4">--}}
            {{--                {!! $article->article !!}--}}
            {{--            </p>--}}
        </div>
    </div>
@endsection
