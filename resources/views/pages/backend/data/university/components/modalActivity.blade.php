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
            <label>{{ __('Nama Universitas') }}<code>*</code></label>
            <select name="university_id" class="form-control select2" required>
                <option value="">{{ __('Pilih Universitas') }}</option>
                @foreach ($universities as $university)
                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>{{ __('Nama Fakultas') }}<code>*</code></label>
            <input type="text" name="name" class="form-control" required>
        </div>
    @elseif(Request::route()->getName() == 'major.index')
        <div class="form-group">
            <label>{{ __('Nama Fakultas') }}<code>*</code></label>
            <select name="faculty_id" class="form-control select2" required>
                <option value="">{{ __('Pilih Fakultas') }}</option>
                @foreach ($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>
        {{--        <div class="form-group">--}}
        {{--            <label>{{ __('Nama Jurusan') }}<code>*</code></label>--}}
        {{--            <input type="text" name="name" class="form-control" required autofocus>--}}
        {{--        </div>--}}
        <div class="form-group">
            <label>{{ __('Nama Jurusan') }}<code>*</code></label>
            <select name="major_id" class="form-control select2" required>
                <option value="">{{ __('Pilih Jurusan') }}</option>
                @foreach ($majors as $major)
                    <option value="{{ $major->id }}">{{ $major->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
</form>
