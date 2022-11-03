@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Edit Alternatif'))
@section('backToContent')
    @include('pages.backend.components.backToContent',['url'=>route('dashboard.alternative')])
@endsection
@section('titleContent', __('Edit Fakultas'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Alternatif') }}</div>
    <div class="breadcrumb-item active">{{ __('Edit Alternatif') }}</div>
@endsection

@section('content')
    <div class="card">
        <form id="stored">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ __('Nama Alternative') }}<code>*</code></label>
                    <input type="text" class="form-control" value="{{ $alternative->name }}" readonly>
                </div>
                <div class="form-group">
                    <label>{{ __('Urutan Alternative') }}<code>*</code></label>
                    <input type="number" name="order" class="form-control" value="{{ $alternative->order }}" required>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" onclick="update()" type="button">{{ __('pages.edit') }}</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        var url = '{{ route('dashboard.alternative.update',$alternative->id) }}';
        var index = '{{ route('dashboard.alternative') }}';
    </script>
    <script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection
