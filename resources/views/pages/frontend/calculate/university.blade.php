<div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
    @isset($alternative)
        <div class="section-title">Legends</div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Universitas</th>
                <th scope="col">Code</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alternative as $univ)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $univ->name }}</td>
                    <td>{{ $univ->code }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endisset
    <div class="section-title">Perbandingan Bobot Kriteria</div>
    @foreach (json_decode($criteriaUniversity) as $univ)
        <div class="row align-items-center">
            <div class="col">
                <h6 class="d-flex justify-content-end">
                    @foreach($criteria as $c)
                        @if($c->id === $univ->criteria1)
                            {{ $c->name }}
                        @endif
                    @endforeach
                </h6>
            </div>
            <div class="col">
                <div class="btn-toolbar justify-content-center">
                    <div class="text-center">
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="kriteria{{ $univ->id }}" value="1" class="selectgroup-input">
                                <span class="selectgroup-button">1</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kriteria{{ $univ->id }}" value="2" class="selectgroup-input">
                                <span class="selectgroup-button">2</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kriteria{{ $univ->id }}" value="3" class="selectgroup-input">
                                <span class="selectgroup-button">3</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kriteria{{ $univ->id }}" value="4" class="selectgroup-input">
                                <span class="selectgroup-button">4</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kriteria{{ $univ->id }}" value="5" class="selectgroup-input"
                                       checked>
                                <span class="selectgroup-button">5</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kriteria{{ $univ->id }}" value="6" class="selectgroup-input">
                                <span class="selectgroup-button">6</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kriteria{{ $univ->id }}" value="7" class="selectgroup-input">
                                <span class="selectgroup-button">7</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kriteria{{ $univ->id }}" value="8" class="selectgroup-input">
                                <span class="selectgroup-button">8</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="kriteria{{ $univ->id }}" value="9" class="selectgroup-input">
                                <span class="selectgroup-button">9</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <h6 class="d-flex justify-content-start">
                    @foreach($criteria as $c)
                        @if($c->id === $univ->criteria2)
                            {{ $c->name }}
                        @endif
                    @endforeach
                </h6>
            </div>
        </div>
    @endforeach
    <div class="section-title">Perbandingan Bobot Alternatif</div>
    @foreach (json_decode($alternativeUniversity) as $altUniv)
        <div class="row align-items-center">
            <div class="col">
                <h6 class="d-flex justify-content-end">
                    @foreach($universities as $c)
                        @if($c->id === $altUniv->alternative1)
                            {{ $c->name }}
                        @endif
                    @endforeach
                </h6>
            </div>
            <div class="col">
                <div class="btn-toolbar justify-content-center" role="toolbar"
                     aria-label="Toolbar with button groups">
                    <div class="text-center">
                        <div class="selectgroup w-100">
                            <label class="selectgroup-item">
                                <input type="radio" name="alternatif{{ $altUniv->id }}" value="1"
                                       class="selectgroup-input">
                                <span class="selectgroup-button">1</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="alternatif{{ $altUniv->id }}" value="2"
                                       class="selectgroup-input">
                                <span class="selectgroup-button">2</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="alternatif{{ $altUniv->id }}" value="3"
                                       class="selectgroup-input">
                                <span class="selectgroup-button">3</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="alternatif{{ $altUniv->id }}" value="4"
                                       class="selectgroup-input">
                                <span class="selectgroup-button">4</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="alternatif{{ $altUniv->id }}" value="5"
                                       class="selectgroup-input"
                                       checked>
                                <span class="selectgroup-button">5</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="alternatif{{ $altUniv->id }}" value="6"
                                       class="selectgroup-input">
                                <span class="selectgroup-button">6</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="alternatif{{ $altUniv->id }}" value="7"
                                       class="selectgroup-input">
                                <span class="selectgroup-button">7</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="alternatif{{ $altUniv->id }}" value="8"
                                       class="selectgroup-input">
                                <span class="selectgroup-button">8</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="alternatif{{ $altUniv->id }}" value="9"
                                       class="selectgroup-input">
                                <span class="selectgroup-button">9</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <h6 class="d-flex justify-content-start">
                    @foreach($universities as $c)
                        @if($c->id === $altUniv->alternative2)
                            {{ $c->name }}
                        @endif
                    @endforeach
                </h6>
            </div>
        </div>
        {{--                        @foreach($criteria as $c)--}}
        {{--                            @if($c->id === $univ->criteria1)--}}
        {{--                                {{ $c->name }} ---}}
        {{--                            @endif--}}
        {{--                            @if($c->id === $univ->criteria2)--}}
        {{--                                {{ $c->name }}<br>--}}
        {{--                            @endif--}}
        {{--                        @endforeach--}}
    @endforeach
    {{--                    @foreach($criteria as $c)--}}
    {{--                        @foreach($criteriaUniversity as $cu)--}}
    {{--                            @if($c->id != $cu->id)--}}
    {{--                                {{ $c->name }} - {{ $cu->name }}<br>--}}
    {{--                            @endif--}}
    {{--                        @endforeach--}}
    {{--                    @endforeach--}}
    {{--                    @php--}}
    {{--                        @endphp--}}
    {{--                    @foreach($criteria as $c)--}}
    {{--                        @foreach($criteria as $c2)--}}
    {{--                            @if($c->id === $c2->id)--}}
    {{--                                @continue--}}
    {{--                            @endif--}}
    {{--                        @endforeach--}}
    {{--                    @endforeach--}}
    {{--                    @isset($criteria)--}}
    {{--                        <table class="table table-hover table-responsive">--}}
    {{--                            <thead>--}}
    {{--                            <tr>--}}
    {{--                                <th scope="col">No</th>--}}
    {{--                                <th scope="col">Kriteria</th>--}}
    {{--                                @foreach($criteria as $c)--}}
    {{--                                    <th scope="col">{{ $c->name }}</th>--}}
    {{--                                @endforeach--}}
    {{--                            </tr>--}}
    {{--                            </thead>--}}
    {{--                            <tbody>--}}
    {{--                            @foreach($criteria as $c)--}}
    {{--                                <tr>--}}
    {{--                                    <th scope="row">{{ $loop->iteration }}</th>--}}
    {{--                                    <td>{{ $c->name }}</td>--}}
    {{--                                    @foreach($criteria as $c2)--}}
    {{--                                        @if($c->id === $c2->id)--}}
    {{--                                            <td>1</td>--}}
    {{--                                        @else--}}
    {{--                                            <td>--}}
    {{--                                                <input type="number" class="form-control" name="criteria[{{ $c->id }}][{{ $c2->id }}]" value="1">--}}
    {{--                                            </td>--}}
    {{--                                        @endif--}}
    {{--                                    @endforeach--}}
    {{--                                </tr>--}}
    {{--                            @endforeach--}}
    {{--                            </tbody>--}}
    {{--                        </table>--}}
    {{--                    @endisset--}}
    {{--                    @foreach($criteria as $c)--}}
    {{--                        {{ $c->name }} - {{ $c->code }} <br>--}}
    {{--                        @foreach($criteria as $c2)--}}
    {{--                            @if($c->id !== $c2->id)--}}
    {{--                                {{ $c->name }} - {{ $c2->name }} <br>--}}
    {{--                                <input type="number" name="criteria[{{ $c->id }}][{{ $c2->id }}]" class="form-control"--}}
    {{--                                       placeholder="Nilai Perbandingan">--}}
    {{--                            @endif--}}
    {{--                        @endforeach--}}
    {{--                    @endforeach--}}

    {{--                    <div class="btn-toolbar justify-content-center" role="toolbar"--}}
    {{--                         aria-label="Toolbar with button groups">--}}
    {{--                        <h6 class="align-self-center mr-3">--}}
    {{--                            C01--}}
    {{--                        </h6>--}}
    {{--                        <div class="btn-group mb-3 btn-group-toggle" role="group" aria-label="Basic example">--}}
    {{--                            <button type="button" class="btn btn-danger">1</button>--}}
    {{--                            <button type="button" class="btn btn-primary">2</button>--}}
    {{--                            <button type="button" class="btn btn-primary">3</button>--}}
    {{--                            <button type="button" class="btn btn-primary">4</button>--}}
    {{--                            <button type="button" class="btn btn-warning">5</button>--}}
    {{--                            <button type="button" class="btn btn-primary">6</button>--}}
    {{--                            <button type="button" class="btn btn-primary">7</button>--}}
    {{--                            <button type="button" class="btn btn-primary">8</button>--}}
    {{--                            <button type="button" class="btn btn-success">9</button>--}}
    {{--                        </div>--}}
    {{--                        <h6 class="align-self-center ml-3">--}}
    {{--                            C01--}}
    {{--                        </h6>--}}
    {{--                    </div>--}}
</div>
