@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Data Universitas'))
@section('titleContent', __('Universitas'))
@section('breadcrumb', __('Data'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Universitas') }}</div>
@endsection

@section('content')
    @include('layouts.backend.components.notification')
    <div class="card card-primary">
        <div class="card-body">
            <table class="table-hover table" id="table" width="100%">
                <thead>
                <tr>
                    <th>
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Fakultas') }}</th>
                    <th>{{ __('Jurusan') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($faculty as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <ul>
                                @foreach ($item->majors as $major)
                                    <li>{{ $major->name }}</li>
                                @endforeach
                            </ul>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('modal')
    @include('pages.backend.data.university.components.modalActivity')
@endsection
