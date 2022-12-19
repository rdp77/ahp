@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | ').__('Laporan'))
@section('backToContent')
    @include('pages.backend.components.backToContent',['url'=>route('dashboard')])
@endsection
@section('titleContent', __('Laporan'))

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
                    <th>{{ __('Rekomendasi') }}</th>
                    <th>{{ __('Nama Pengguna') }}</th>
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
        var index = '{{ route('dashboard.report') }}';
    </script>
    <script src="{{ asset('assets/pages/data/report.js') }}"></script>
@endsection
