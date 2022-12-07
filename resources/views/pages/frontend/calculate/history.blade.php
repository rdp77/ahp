@extends('layouts.calculate')
@section('title', __('Jurusan Finder | History'))

@section('content')
    <div class="card card-info">
        <div class="card-body">
            @isset($university)
                <div class="section-title">Rekomendasi Universitas</div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Nama Universitas</th>
                        <th scope="col">Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($university as $univ)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <th>{{ $univ['name'] }}</th>
                            <td>{{ $univ['value'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="section-title">Rekomendasi Jurusan</div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Nama Jurusan</th>
                        <th scope="col">Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($major as $maj)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <th>{{ $maj['name'] }}</th>
                            <td>{{ $maj['value'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="section-title">Rekomendasi Utama</div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Nama Universitas</th>
                        <th scope="col">Nama Jurusan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>{{ $recommendation['university']['name'] }}</th>
                        <td>{{ $recommendation['major']['name'] }}</td>
                    </tr>
                    </tbody>
                </table>
            @endisset
            @isset($activity)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Rekomendasi</th>
                        <th scope="col">Lihat</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($activity as $act)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <th>{{ \Carbon\Carbon::parse($act->created_at)->format('d-m-Y') }}</th>
                            <td>{!! $act->properties['recommendation']['university']['name'] .' - '. $act->properties['recommendation']['major']['name'] !!}</td>
                            <td>
                                <a href="{{ route('calculate.history.show', $act->id) }}"
                                   class="btn btn-primary">Lihat</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endisset
        </div>
    </div>
@endsection
