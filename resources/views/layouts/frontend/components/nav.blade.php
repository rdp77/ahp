<nav class="navbar navbar-reverse navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand smooth" href="{{ route('home') }}">JURUSAN FINDER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto align-items-lg-center d-none d-lg-block">
                <li class="ml-lg-3 nav-item">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-round smooth btn-icon icon-left">
                            <i class="fa-solid fa-right-to-bracket"></i> Dashboard
                        </a>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-round smooth btn-icon icon-left">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </a>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>
