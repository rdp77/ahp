@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Tambah Fakultas'))
@section('backToContent')
    @include('pages.backend.components.backToContent',['url'=>route('data.faculty.index')])
@endsection
@section('titleContent', __('Tambah Fakultas'))
@section('breadcrumb', __('Universitas'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Fakultas') }}</div>
    <div class="breadcrumb-item active">{{ __('Tambah Fakultas') }}</div>
@endsection

@section('content')
    <div class="card">
        <form id="stored">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ __('Nama Universitas') }}<code>*</code></label>
                    <select name="university_id" class="form-control select2" required>
                        <option value="">{{ __('Pilih Universitas') }}</option>
                        @foreach ($universities as $university)
                            <option value="{{ $university->id }}">{{ $university->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ __('Nama Fakultas') }}<code>*</code></label>
                    <select name="faculty_id" class="form-control select2" required>
                        <option value="">{{ __('Pilih Fakultas') }}</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" onclick="save()" type="button">{{ __('pages.edit') }}</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        const url = '{{ route('data.faculty.store') }}';
        const index = '{{ route('data.faculty.index') }}';
    </script>
    <script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection
