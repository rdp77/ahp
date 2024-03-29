@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Edit Fakultas'))
@section('backToContent')
    @include('pages.backend.components.backToContent',['url'=>route('data.faculty.index')])
@endsection
@section('titleContent', __('Edit Fakultas'))
@section('breadcrumb', __('Universitas'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Fakultas') }}</div>
    <div class="breadcrumb-item active">{{ __('Edit Fakultas') }}</div>
@endsection

@section('content')
    <div class="card">
        <form id="stored">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ __('Nama Universitas') }}<code>*</code></label>
                    <input type="text" class="form-control" value="{{ $university->name }}" required readonly>
                </div>
                <div class="form-group">
                    <label>{{ __('Nama Fakultas') }}<code>*</code></label>
                    <select name="faculty_id[]" class="form-control select2" multiple required>
                        <option disabled>{{ __('Pilih Fakultas') }}</option>
                        @foreach ($faculties as $faculty)
                            <option
                                value="{{ $faculty->id }}" {{ $university->faculties->contains($faculty->id) ? 'selected' : '' }}>{{ $faculty->name }}</option>
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
        const url = '{{ route('data.faculty.update',$university->id) }}';
        const index = '{{ route('data.faculty.index') }}';
    </script>
    <script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection
