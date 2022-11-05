@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Universitas'))
@section('backToContent')
    <div class="section-header-back">
        <a href="{{ route('university.index') }}" class="btn btn-icon">
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>
@endsection
@section('titleContent', __('Universitas'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Master') }}</div>
    <div class="breadcrumb-item active">{{ __('Universitas') }}</div>
    <div class="breadcrumb-item active">{{ __('Recycle Bin') }}</div>
@endsection

@section('content')
    @include('pages.backend.components.filterSearch')
    @include('layouts.backend.components.notification')
    <div class="card">
        <div class="card-header">
            <div class="card-header-action">
                <button onclick="delAll()" class="btn btn-icon icon-left btn-danger">
                    <i class="far fa-trash-alt"></i>{{ __('Hapus Semua') }}
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table-striped table" id="table" width="100%">
                <thead>
                <tr>
                    <th>
                        {{ __('No') }}
                    </th>
                    <th>{{ __('Kode') }}</th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Alamat') }}</th>
                    <th>{{ __('No HP') }}</th>
                    <th>{{ __('Urutan') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var index = '{{ route('university.recycle') }}';
    </script>
    <script src="{{ asset('assets/pages/data/master/university.js') }}"></script>
@endsection
