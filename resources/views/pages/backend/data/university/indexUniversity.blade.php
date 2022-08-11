@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Data Universitas'))
@section('titleContent', __('Universitas'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Universitas') }}</div>
@endsection

@section('content')
@include('pages.backend.components.filterSearch')
@include('layouts.backend.components.notification')
<div class="card">
    <div class="card-header">
        <button id="modal" class="btn btn-icon icon-left btn-primary mr-2">
            <i class="far fa-edit"></i>{{ __(' Tambah Universitas') }}
        </button>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="table" width="100%">
            <thead>
                <tr>
                    <th>
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Kode') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Alamat') }}</th>
                    <th>{{ __('No HP') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('modal')
@include('pages.backend.data.university.components.modalActivity')
@endsection
@section('script')
<script>
    var index = '{{ route('university.index') }}';
    var store = '{{ route('university.store') }}';    
</script>
<script src="{{ asset('assets/pages/data/university/index.js') }}"></script>
@endsection