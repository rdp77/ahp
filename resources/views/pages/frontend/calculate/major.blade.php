<div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
    @isset($alternativeuniv)
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
            @foreach($alternativeuniv as $univ)
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
    <input type="hidden" name="alternativemaj" value="{!! $alternativemajids !!}">
    @foreach($alternativemaj as $key => $value)
        <input type="hidden" name="alternativesmaj[{{ $key }}]" class="alternative-input form-control"
               value="{{ $value->name }}">
    @endforeach
    @foreach($criteriaMaj as $index=>$criteria)
        <input type="hidden" name="criteriamaj[{{ $index }}]" class="criteria-input form-control"
               value="{{ $criteria->name }}">
        <input type="hidden" name="typesmaj[{{ $index }}]" class="criteria-input form-control"
               value="0">
    @endforeach
    <div class="section-title">Perbandingan Bobot Kriteria (Relative Interest Matrix)</div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="black white-text">
            <tr id="table-matrix-interest-atas">
                {!! $matrixMaj['tr'] !!}
            </tr>
            </thead>
            <tbody id="table-matrix-interest-bawah">
            {!! $matrixMaj['tbody'] !!}
            </tbody>
        </table>
    </div>
    <div class="section-title">Perbandingan Bobot Alternatif (Matrix PairWise)</div>
    <div class="card-body px-lg-5 pt-0 mt-2 collapse show" id="pairwise-body-maj">
        {!! $matrixPairWiseMaj !!}
    </div>
</div>


