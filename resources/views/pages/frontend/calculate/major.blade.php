<div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
    @isset($alternative)
        <div class="section-title">Legends</div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Universitas</th>
                <th scope="col">Fakultas</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alternative as $univ)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $univ->name }}</td>
                    <td>
                        @foreach($univ->majors as $major)
                            <span class="badge badge-dark m-1">{{ $major->name }}</span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endisset
    <div class="section-title">Perbandingan Bobot Kriteria (Relative Interest Matrix)</div>
    <div class="text-center mb-2">
        <button type="button" class="btn btn-outline-dark" onclick="generateInterestRelativeMatrixMaj();">
            Generate Matrix
        </button>
    </div>
    @foreach($criteriaMaj as $index => $maj)
        <input type="hidden" name="criteriasmaj[{{ $index }}]" value="{{ $maj->name }}" class="criteriamaj">
        <input type="hidden" value="0" name="typesmaj[{{ $index }}]">
    @endforeach
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="black white-text">
            <tr id="table-matrix-interest-atas-maj">
            </tr>
            </thead>
            <tbody id="table-matrix-interest-bawah-maj">
            </tbody>
        </table>
    </div>

    {{--    @foreach (json_decode($criteriaMajor) as $major)--}}
    {{--        <div class="row align-items-center">--}}
    {{--            <div class="col">--}}
    {{--                <h6 class="d-flex justify-content-end">--}}
    {{--                    @foreach($criteria as $c)--}}
    {{--                        @if($c->id === $major->criteria1)--}}
    {{--                            {{ $c->name }}--}}
    {{--                        @endif--}}
    {{--                    @endforeach--}}
    {{--                </h6>--}}
    {{--            </div>--}}
    {{--            <div class="col">--}}
    {{--                <div class="btn-toolbar justify-content-center">--}}
    {{--                    <div class="text-center">--}}
    {{--                        <div class="selectgroup w-100">--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="kriteria-maj-{{ $major->id }}" value="1"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">1</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="kriteria-maj-{{ $major->id }}" value="2"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">2</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="kriteria-maj-{{ $major->id }}" value="3"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">3</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="kriteria-maj-{{ $major->id }}" value="4"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">4</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="kriteria-maj-{{ $major->id }}" value="5"--}}
    {{--                                       class="selectgroup-input"--}}
    {{--                                       checked>--}}
    {{--                                <span class="selectgroup-button">5</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="kriteria-maj-{{ $major->id }}" value="6"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">6</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="kriteria-maj-{{ $major->id }}" value="7"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">7</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="kriteria-maj-{{ $major->id }}" value="8"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">8</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="kriteria-maj-{{ $major->id }}" value="9"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">9</span>--}}
    {{--                            </label>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col">--}}
    {{--                <h6 class="d-flex justify-content-start">--}}
    {{--                    @foreach($criteria as $c)--}}
    {{--                        @if($c->id === $major->criteria2)--}}
    {{--                            {{ $c->name }}--}}
    {{--                        @endif--}}
    {{--                    @endforeach--}}
    {{--                </h6>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    @endforeach--}}
    <div class="section-title">Perbandingan Bobot Alternatif (Matrix PairWise)</div>
    <div class="text-center mb-2">
        <button type="button" class="btn btn-outline-dark" onclick="generatePairWiseMatrixMaj();">
            Generate Matrix
        </button>
    </div>
    @foreach($alternativeMaj as $altMaj)
        <input type="hidden" name="alternativesmaj[]" class="alternative-inputmaj form-control"
               value="{{ $altMaj->name }}">
    @endforeach
    <div class="card-body px-lg-5 pt-0 mt-2 collapse show" id="pairwise-body-maj">
    </div>
    {{--    @foreach (json_decode($alternativeMajor) as $altMaj)--}}
    {{--        <div class="row align-items-center">--}}
    {{--            <div class="col">--}}
    {{--                <h6 class="d-flex justify-content-end">--}}
    {{--                    @foreach($majors as $c)--}}
    {{--                        @if($c->id === $altMaj->alternative1)--}}
    {{--                            {{ $c->name }}--}}
    {{--                        @endif--}}
    {{--                    @endforeach--}}
    {{--                </h6>--}}
    {{--            </div>--}}
    {{--            <div class="col">--}}
    {{--                <div class="btn-toolbar justify-content-center" role="toolbar"--}}
    {{--                     aria-label="Toolbar with button groups">--}}
    {{--                    <div class="text-center">--}}
    {{--                        <div class="selectgroup w-100">--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="alternatif-maj-{{ $altMaj->id }}" value="1"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">1</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="alternatif-maj-{{ $altMaj->id }}" value="2"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">2</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="alternatif-maj-{{ $altMaj->id }}" value="3"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">3</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="alternatif-maj-{{ $altMaj->id }}" value="4"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">4</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="alternatif-maj-{{ $altMaj->id }}" value="5"--}}
    {{--                                       class="selectgroup-input"--}}
    {{--                                       checked>--}}
    {{--                                <span class="selectgroup-button">5</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="alternatif-maj-{{ $altMaj->id }}" value="6"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">6</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="alternatif-maj-{{ $altMaj->id }}" value="7"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">7</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="alternatif-maj-{{ $altMaj->id }}" value="8"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">8</span>--}}
    {{--                            </label>--}}
    {{--                            <label class="selectgroup-item">--}}
    {{--                                <input type="radio" name="alternatif-maj-{{ $altMaj->id }}" value="9"--}}
    {{--                                       class="selectgroup-input">--}}
    {{--                                <span class="selectgroup-button">9</span>--}}
    {{--                            </label>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col">--}}
    {{--                <h6 class="d-flex justify-content-start">--}}
    {{--                    @foreach($majors as $c)--}}
    {{--                        @if($c->id === $altMaj->alternative2)--}}
    {{--                            {{ $c->name }}--}}
    {{--                        @endif--}}
    {{--                    @endforeach--}}
    {{--                </h6>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    @endforeach--}}
</div>
{{--@section('scripts')--}}
{{--    <script src="{{ asset('assets/pages/ahpmaj.js') }}"></script>--}}
{{--@endsection--}}
<style>
    .form-control {
        width: 70px;
    }
</style>

