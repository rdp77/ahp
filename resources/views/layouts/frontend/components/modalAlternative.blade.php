<form class="modal-part" id="modal-search">
    @csrf
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
            <label class="custom-control-label" for="check-major">{{ __('Pilih Semua Jurusan') }}</label>
        </div>
    </div>
</form>
