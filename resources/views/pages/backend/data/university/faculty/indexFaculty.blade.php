@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Data Fakultas'))
@section('titleContent', __('Fakultas'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Universitas') }}</div>
<div class="breadcrumb-item active">{{ __('Fakultas') }}</div>
@endsection

@section('content')
@include('pages.backend.components.filterSearch')
@include('layouts.backend.components.notification')
<div class="card">
    <div class="card-header">
        <button id="modal" class="btn btn-icon icon-left btn-primary mr-2">
            <i class="far fa-edit"></i>{{ __(' Tambah Fakultas') }}
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
                    <th>{{ __('Universitas') }}</th>
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
    var index = '{{ route('faculty.index') }}';    
    var store = '{{ route('faculty.store') }}';    
</script>
<script src="{{ asset('assets/pages/data/university/faculty.js') }}"></script>
@endsection