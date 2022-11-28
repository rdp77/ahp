@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | ').__('Feedback'))
@section('backToContent')
@include('pages.backend.components.backToContent',['url'=>route('dashboard')])
@endsection
@section('titleContent', __('Feedback'))

@section('content')
@include('pages.backend.components.filterSearch')
<div class="card card-primary">
    <div class="card-body">
        <table class="table-striped table" id="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Reaksi') }}</th>
                    <th>{{ __('Alasan') }}</th>
                    <th>{{ __('Tanggal') }}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
    <script>
        var index = '{{ route('dashboard.feedback') }}';
    </script>
    <script src="{{ asset('assets/pages/data/feedback.js') }}"></script>
@endsection
