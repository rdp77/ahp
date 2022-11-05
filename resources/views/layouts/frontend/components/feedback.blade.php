<form class="modal-part" id="modal-body">
    @csrf
    <div class="form-group">
        <label class="form-label">Reaksi</label>
        <div class="selectgroup w-100">
            <label class="selectgroup-item">
                <input type="radio" name="react" value="1" class="selectgroup-input" checked>
                <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-thumbs-up"></i> Suka</span>
            </label>
            <label class="selectgroup-item">
                <input type="radio" name="react" value="0" class="selectgroup-input">
                <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-thumbs-down"></i> Tidak
                    Suka</span>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label>{{ __('Alasan') }}</label>
        <textarea name="reason" class="form-control" style="height: 100px" required></textarea>
    </div>
</form>
