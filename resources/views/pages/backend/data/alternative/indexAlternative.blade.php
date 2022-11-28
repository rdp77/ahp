@extends('layouts.backend.default')
@section('title', 'Data Alternative')
@section('titleContent', __('Alternatif'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Alternatif') }}</div>
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
                    <th>{{ __('Tipe') }}</th>
                    <th>{{ __('Urutan') }}</th>
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
        var index = '{{ route('dashboard.alternative') }}';
    </script>
    <script src="{{ asset('assets/pages/data/ratio.js') }}"></script>
@endsection
