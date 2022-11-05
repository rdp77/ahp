@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Edit Jurusan'))
@section('backToContent')
    @include('pages.backend.components.backToContent',['url'=>route('major.index')])
@endsection
@section('titleContent', __('Edit Jurusan'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Master') }}</div>
    <div class="breadcrumb-item active">{{ __('Jurusan') }}</div>
    <div class="breadcrumb-item active">{{ __('Edit') }}</div>
@endsection

@section('content')
    <div class="card">
        <form id="stored">
            <div class="card-body">
                <div class="form-group">
                    <div class="d-block">
                        <label for="name" class="control-label">{{ __('Nama') }}<code>*</code></label>
                    </div>
                    <input id="name" type="text" class="form-control" name="name" value="{{ $major->name }}" required
                           autofocus>
                </div>
                <div class="form-group">
                    <label>{{ __('Urutan') }}<code>*</code></label>
                    <input type="number" name="order" class="form-control" value="{{ $major->order }}"
                           required>
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
        var url = '{{ route('major.update',$major->id) }}';
        var index = '{{ route('major.index') }}';
    </script>
    <script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection
