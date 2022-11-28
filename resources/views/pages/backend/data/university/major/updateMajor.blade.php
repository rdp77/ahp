@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Edit Jurusan'))
@section('backToContent')
    @include('pages.backend.components.backToContent',['url'=>route('data.major.index')])
@endsection
@section('titleContent', __('Edit Jurusan'))
@section('breadcrumb', __('Universitas'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Jurusan') }}</div>
    <div class="breadcrumb-item active">{{ __('Edit Jurusan') }}</div>
@endsection

@section('content')
    <div class="card">
        <form id="stored">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ __('Nama Fakultas') }}<code>*</code></label>
                    <input type="text" class="form-control" value="{{ $faculty->name }}" required readonly>
                </div>
                <div class="form-group">
                    <label>{{ __('Nama Jurusan') }}<code>*</code></label>
                    <select name="major_id[]" class="form-control select2" multiple required>
                        <option disabled>{{ __('Pilih Jurusan') }}</option>
                        @foreach ($majors as $major)
                            <option
                                value="{{ $major->id }}" {{ $faculty->majors->contains($major->id) ? 'selected' : '' }}>{{ $major->name }}</option>
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
        const url = '{{ route('data.major.update',$faculty->id) }}';
        const index = '{{ route('data.major.index') }}';
    </script>
    <script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection
