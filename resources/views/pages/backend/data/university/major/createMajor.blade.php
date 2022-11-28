@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Tambah Jurusan'))
@section('backToContent')
    @include('pages.backend.components.backToContent',['url'=>route('data.major.index')])
@endsection
@section('titleContent', __('Tambah Jurusan'))
@section('breadcrumb', __('Universitas'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Jurusan') }}</div>
    <div class="breadcrumb-item active">{{ __('Tambah Jurusan') }}</div>
@endsection

@section('content')
    <div class="card">
        <form id="stored">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ __('Nama Universitas') }}<code>*</code></label>
                    <select name="university_id" class="form-control select2" id="university" required>
                        @foreach ($universities as $university)
                            <option value="{{ $university->id }}">{{ $university->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ __('Nama Fakultas') }}<code>*</code></label>
                    <select name="faculty_id" class="form-control select2" id="faculty" required>
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ __('Nama Jurusan') }}<code>*</code></label>
                    <select name="major_id" class="form-control select2" required>
                        @foreach ($majors as $major)
                            <option value="{{ $major->id }}">{{ $major->name }}</option>
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
        const url = '{{ route('data.major.store') }}';
        const index = '{{ route('data.major.index') }}';
    </script>
    <script src="{{ asset('assets/pages/stored.js') }}"></script>
    <script src="{{ asset('assets/pages/data/university/major.js') }}"></script>
@endsection
