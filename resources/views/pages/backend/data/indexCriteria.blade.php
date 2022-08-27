@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Data Kriteria'))
@section('titleContent', __('Kriteria'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Kriteria') }}</div>
@endsection

@section('content')
    @include('pages.backend.components.filterSearch')
    @include('layouts.backend.components.notification')
    <div class="card">
        <div class="card-body">
            <table class="table-striped table" id="table" width="100%">
                <thead>
                <tr>
                    <th>
                        {{ __('No') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
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
        var index = '{{ route('dashboard.criteria') }}';
    </script>
    <script src="{{ asset('assets/pages/data/ratio.js') }}"></scrip>
@endsection
