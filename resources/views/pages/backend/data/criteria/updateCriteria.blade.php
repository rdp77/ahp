@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Edit Kriteria'))
@section('backToContent')
    @include('pages.backend.components.backToContent',['url'=>route('dashboard.criteria')])
@endsection
@section('titleContent', __('Edit Kriteria'))
@section('breadcrumb', __('AHP'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Kriteria') }}</div>
    <div class="breadcrumb-item active">{{ __('Edit Kriteria') }}</div>
@endsection

@section('content')
    <div class="card">
        <form id="stored">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ __('Nama Kriteria') }}<code>*</code></label>
                    <input type="text" class="form-control" value="{{ $criteria->name }}" readonly>
                </div>
                <div class="form-group">
                    <label>{{ __('Urutan Kriteria') }}<code>*</code></label>
                    <input type="number" name="order" class="form-control" value="{{ $criteria->order }}" required>
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
        var url = '{{ route('dashboard.criteria.update',$criteria->id) }}';
        var index = '{{ route('dashboard.criteria') }}';
    </script>
    <script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection
