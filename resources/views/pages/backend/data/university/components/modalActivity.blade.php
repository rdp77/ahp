<form class="modal-part" id="modal-body">
    @csrf
    @if (Request::route()->getName() == 'university.index')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>{{ __('Nama Universitas') }}<code>*</code></label>
                <input type="text" name="name" class="form-control" required>
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
    <div class="form-group">
        <label>{{ __('Universitas') }}<code>*</code></label>
        <select class="form-control select2" name="university_id" required>
            @foreach ($university as $u)
            <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
    </div>
    @endif
</form>