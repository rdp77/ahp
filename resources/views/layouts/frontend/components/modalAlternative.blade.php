<div class="modal fade " tabindex="-1" role="dialog" id="search">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih data alternative atau tujuan jurusan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('calculate.create') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('Nama Jurusan') }}<code>*</code></label>
                        <select name="alternative[]" class="form-control select2" multiple required id="alternative">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($alternative as $major)
                                <option value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="check" class="custom-control-input" id="check-major">
                            <label class="custom-control-label"
                                   for="check-major">{{ __('Pilih Semua Jurusan') }}</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Analisa Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
