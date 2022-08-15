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
    <div class="card-body">
        <table class="table-striped table" id="table" width="100%">
            <thead>
                <tr>
                    <th>
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Universitas') }}</th>
                    <th>{{ __('Fakultas') }}</th>
                    <th>{{ __('Jurusan') }}</th>
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
    var index = '{{ route('university.all') }}';  
</script>
<script src="{{ asset('assets/pages/data/university/university-all.js') }}"></script>
@endsection