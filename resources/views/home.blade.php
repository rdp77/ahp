@extends('layouts.frontend.default')
@section('title', __('pages.title'))
@section('titleContent', __('auth.login'))

@section('script')
    <script>
        let feedback = '{{ route('feedback') }}';
        let calculate = '{{ route('calculate.create') }}';
    </script>
    <script src="{{ asset('assets/pages/front/index.js') }}"></script>
@endsection
