@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Data Jurusan'))
@section('titleContent', __('Jurusan'))
@section('breadcrumb', __('Universitas'))
@section('morebreadcrumb')
    <div class="breadcrumb-item active">{{ __('Jurusan') }}</div>
@endsection

@section('content')
    @include('pages.backend.components.filterSearch')
    @include('layouts.backend.components.notification')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('data.major.create') }}" class="btn btn-icon icon-left btn-primary mr-2">
                <i class="far fa-edit"></i>{{ __(' Tambah Jurusan') }}
            </a>
        </div>
        <div class="card-body">
            <table class="table-striped table" id="table" width="100%">
                <thead>
                <tr>
                    <th>
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Nama Universitas') }}</th>
                    <th>{{ __('Daftar Fakultas') }}</th>
                    <th>{{ __('Daftar Jurusan') }}</th>
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
        const index = '{{ route('data.major.index') }}';
    </script>
    <script src="{{ asset('assets/pages/data/university/major.js') }}"></script>
@endsection
