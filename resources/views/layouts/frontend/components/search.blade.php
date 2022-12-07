<section id="try" class="section-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h2>Cari <span class="text-primary">Jurusanmu</span> Sekarang!</h2>
                <p class="lead">Untuk mendapatkan hasil yang maksimal isi semua pertanyaan yang dibutuhkan ya, dan
                    jangan lupa tekan tombol prediksi untuk mendapatkan jawabannya.</p>
                <div class="mt-4">
                    <button data-toggle="modal" data-target="#search" class="btn mr-3">Cari Sekarang</button>
                    <button data-toggle="modal" data-target="#alternativeDatas" class="btn">Daftar Universitas</button>
                </div>
                @auth
                    <a href="{{ route('calculate.history') }}" class="btn">History Perhitungan</a>
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="alternativeDatas" tabindex="-1" role="dialog" aria-labelledby="alternativeDatasLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alternativeDatasLabel">Daftar Universitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Fakultas</th>
                        <th scope="col">Nama Fakultas</th>
                        <th scope="col">Nama Jurusan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($university as $index => $univ)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $univ->name }}</td>
                            <td>
                                <table class="table table-hover">
                                    <tbody>
                                    @foreach($univ->faculties as $faculty)
                                        <tr>
                                            <td>{{ $faculty->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table class="table table-hover">
                                    <tbody>
                                    @foreach($univ->majors as $major)
                                        <tr>
                                            <td>{{ $major->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
