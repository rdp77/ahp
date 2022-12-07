<div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
    @isset($alternativeuniv)
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
            @foreach($alternativeuniv as $univ)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $univ->name }}</td>
                    <td>{{ $univ->code }}</td>
                </tr>
                <input type="hidden" name="alternativesuniv[]" class="alternative-input form-control"
                       value="{{ $univ->name }}">
            @endforeach
            </tbody>
        </table>
    @endisset
    <input type="hidden" name="alternativeuniv" value="{!! $alternativeunivids !!}">
    @foreach($criteriaUniv as $index=>$criteria)
        <input type="hidden" name="criteriauniv[{{ $index }}]" class="criteria-input form-control"
               value="{{ $criteria->name }}">
        <input type="hidden" name="typesuniv[{{ $index }}]" class="criteria-input form-control"
               value="0">
    @endforeach
    @if(count($alternativeuniv) > 1)
        <div class="section-title">Perbandingan Bobot Kriteria (Relative Interest Matrix)</div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="black white-text">
                <tr id="table-matrix-interest-atas">
                    {!! $matrixUniv['tr'] !!}
                </tr>
                </thead>
                <tbody id="table-matrix-interest-bawah">
                {!! $matrixUniv['tbody'] !!}
                </tbody>
            </table>
        </div>
        <div class="section-title">Perbandingan Bobot Alternatif (Matrix PairWise)</div>
        <div class="card-body px-lg-5 pt-0 mt-2 collapse show" id="pairwise-body">
            {!! $matrixPairWiseUniv !!}
        </div>
    @endif
</div>
