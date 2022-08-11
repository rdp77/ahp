@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Edit Fakultas'))
@section('backToContent')
@include('pages.backend.components.backToContent',['url'=>route('users.index')])
@endsection
@section('titleContent', __('Edit Fakultas'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Universitas') }}</div>
<div class="breadcrumb-item active">{{ __('Fakultas') }}</div>
<div class="breadcrumb-item active">{{ __('Edit Fakultas') }}</div>
@endsection

@section('content')
<div class="card">
    <form id="stored">
        <div class="card-body">
            <div class="form-group">
                <label>{{ __('Nama Fakultas') }}<code>*</code></label>
                <input type="text" name="name" class="form-control" value="{{ $faculty->name }}" required>
            </div>
            <div class="form-group">
                <label>{{ __('Universitas') }}<code>*</code></label>
                <select class="form-control select2" name="university_id[]" multiple required>
                    @foreach ($university as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
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
    var url = '{{ route('faculty.update',$faculty->id) }}';
    var index = '{{ route('faculty.index') }}';
</script>
<script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection