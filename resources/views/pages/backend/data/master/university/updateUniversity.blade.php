@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Edit Universitas'))
@section('backToContent')
    @include('pages.backend.components.backToContent',['url'=>route('university.index')])
@endsection
@section('titleContent', __('Edit Universitas'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Master') }}</div>
    <div class="breadcrumb-item active">{{ __('Universitas') }}</div>
    <div class="breadcrumb-item active">{{ __('Edit') }}</div>
@endsection

@section('content')
    <div class="card">
        <form id="stored">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ __('Nama Universitas') }}<code>*</code></label>
                    <input type="text" name="name" class="form-control" value="{{ $university->name }}" required>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>{{ __('Urutan') }}<code>*</code></label>
                            <input type="number" name="order" class="form-control" value="{{ $university->order }}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Email') }}<code>*</code></label>
                            <input type="email" name="email" class="form-control" value="{{ $university->email }}"
                                   required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>{{ __('Kode') }}<code>*</code></label>
                            <input type="text" name="code" class="form-control" value="{{ $university->code }}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('No Telepon') }}<code>*</code></label>
                            <input type="text" name="phone" class="form-control" value="{{ $university->phone }}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ __('Alamat') }}<code>*</code></label>
                    <textarea name="address" class="form-control" style="height:100px" required>
                    {{ $university->address }}
                </textarea>
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
        var url = '{{ route('university.update',$university->id) }}';
        var index = '{{ route('university.index') }}';
    </script>
    <script src="{{ asset('assets/pages/stored.js') }}"></script>
@endsection
