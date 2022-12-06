@include('layouts.components.header')

<body class="layout-3">
<div id="app">
    <div class="main-wrapper container-fluid">
        <nav class="navbar navbar-expand-lg bg-primary">
            <a class="navbar-brand" href="{{ route('home') }}">Jurusan Finder</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Perhitungan Kriteria</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Perhitungan Alternatif</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">History</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
        <div class="main-content pt-5">
            <section class="section">
                <div class="container-fluid mt-5">
                    @yield('content')
                    <div class="simple-footer">
                        @include('layouts.components.credit')
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@include('layouts.components.footer')
@yield('scripts')
</body>
