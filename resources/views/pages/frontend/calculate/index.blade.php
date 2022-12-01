@extends('layouts.calculate')
@section('title', __('My Blogs'))

@section('content')
    <div class="card card-info">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Bobot</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Deskripsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($weighting as $w)
                    <tr>
                        <th scope="row">{{ $w->value }}</th>
                        <td>{{ $w->name }}</td>
                        <td>{{ $w->detail }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-body">
            <ul class="nav nav-pills justify-content-center mb-3" id="myTab3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                       aria-controls="home" aria-selected="true">Universitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                       aria-controls="profile" aria-selected="false">Jurusan</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent2">
                @include('pages.frontend.calculate.university')
                @include('pages.frontend.calculate.major')
            </div>
        </div>
    </div>
@endsection
