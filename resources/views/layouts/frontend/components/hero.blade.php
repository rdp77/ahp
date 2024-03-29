<div class="hero-wrapper" id="top">
    <div class="hero">
        <div class="container">
            <div class="text text-center text-lg-left">
                @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <a href="javascript:void(0)" class="headline">
                    <div class="badge badge-info">Info</div>
                    Aplikasi Ini Hanyalah Sebagai Rujukan Atau Rekomendasi &nbsp;
                    <i class="fas fa-circle-check"></i>
                </a>
                    <h1>Temukan Minatmu Sekarang!</h1>
                    <p class="lead">
                        Bertujuan untuk membantu calon mahasiswa untuk memilih jurusan
                    </p>
                    <div class="cta">
                        <a class="btn btn-lg btn-white btn-icon icon-right" style="box-shadow: unset;" href="#try">Cocokkan
                            Jurusan <i
                                class="fas fa-chevron-right"></i></a> &nbsp;
                    </div>
            </div>
            <div class="image d-none d-lg-block">
                <img src="{{ asset('assets/img/header.svg') }}" alt="img">
            </div>
        </div>
    </div>
</div>
