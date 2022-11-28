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
                    <label>{{ __('Nama Jurusan') }}<code>*</code></label>
                    <select name="faculty_id" class="form-control select2" required>
                        <option value="">{{ __('Pilih Jurusan') }}</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ __('Nama Jurusan') }}<code>*</code></label>
                    <select name="major_id" class="form-control select2" required>
                        <option value="">{{ __('Pilih Jurusan') }}</option>
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
@endsection
