<form class="modal-part" id="modal-body">
    @csrf
    @if (Request::route()->getName() == 'university.index')
        <div class="form-group">
            <label>{{ __('Nama Universitas') }}<code>*</code></label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Urutan') }}<code>*</code></label>
                    <input type="number" name="order" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>{{ __('Email') }}<code>*</code></label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>{{ __('Kode') }}<code>*</code></label>
                    <input type="text" name="code" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>{{ __('No Telepon') }}<code>*</code></label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('Alamat') }}<code>*</code></label>
            <textarea name="address" class="form-control" style="height:100px" required></textarea>
        </div>
    @elseif(Request::route()->getName() == 'faculty.index')
        <div class="form-group">
            <label>{{ __('Nama Fakultas') }}<code>*</code></label>
            <input type="text" name="name" class="form-control" required>
        </div>
    @elseif(Request::route()->getName() == 'major.index')
        <div class="form-group">
            <label>{{ __('Nama Jurusan') }}<code>*</code></label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>{{ __('Urutan') }}<code>*</code></label>
            <input type="number" name="order" class="form-control" required>
        </div>
    @endif
</form>
