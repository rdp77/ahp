@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Semua Universitas'))
@section('titleContent', __('Universitas ').$university->name)
@section('backToContent')
    @include('pages.backend.components.backToContent',['url'=>route('university.all')])
@endsection
@section('breadcrumb', __('Semua'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Semua Universitas') }}</div>
    <div class="breadcrumb-item active">{{ __('Edit') }}</div>
@endsection

@section('content')
    @include('layouts.backend.components.notification')
    <div class="card">
        <form id="stored">
            <div class="card-body">
                <div class="form-group">
                    <div class="d-block">
                        <label class="control-label">{{ __('Fakultas') }}<code>*</code></label>
                    </div>
                    <select name="faculty[]" class="form-control select2" required="required" multiple>
                        @foreach ($faculty as $f)
                            <option value="{{ $f->id }}">{{ $f->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if(!$university->faculty->isEmpty())
                    <div class="form-group">
                        <div class="d-block">
                            <label class="control-label">{{ __('Fakultas Sebelumnya') }}</label>
                        </div>
                        <select class="form-control select2" multiple disabled>
                            @foreach ($university->faculty as $f)
                                <option selected>{{ $f->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <div class="d-block">
                        <label class="control-label">{{ __('Jurusan') }}<code>*</code></label>
                    </div>
                    <select name="major[]" class="form-control select2" required="required" multiple>
                        @foreach ($major as $m)
                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if(!$university->major->isEmpty())
                    <div class="form-group">
                        <div class="d-block">
                            <label class="control-label">{{ __('Jurusan Sebelumnya') }}</label>
                        </div>
                        <select class="form-control select2" multiple disabled>
                            @foreach ($university->major as $m)
                                <option selected>{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" onclick="update()" type="button">{{ __('pages.edit') }}</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        var url = '{{ route('university.all.update',$university->id) }}';
        var index = '{{ route('university.all') }}';
    </script>
    <script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection
