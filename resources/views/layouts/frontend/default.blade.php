@include('layouts.components.header')

<body>
    @include('layouts.frontend.components.nav')
    @include('layouts.frontend.components.hero')
    @include('layouts.frontend.components.callout')
    @include('layouts.frontend.components.feature')
    <section id="calculated">
        <div class="container">
            <div class="row mb-5 text-center">
                <div class="col-lg-10 offset-lg-1">
                    <h2>Cari <span class="text-primary">Jurusanmu</span> Sekarang!</h2>
                    <p class="lead">Untuk mendapatkan hasil yang maksimal isi semua pertanyaan yang dibutuhkan ya, dan
                        jangan lupa tekan tombol prediksi untuk mendapatkan jawabannya.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                    <a href="#" class="btn btn-block btn-icon icon-left btn-success btn-lg">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Cari Jurusan</a>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.frontend.components.rate')
    @include('layouts.frontend.components.footer')
    @include('layouts.components.footer')
    @yield('script')
</body>

</html>