@extends('layouts.frontend.default')
@section('title', __('pages.title'))
@section('titleContent', __('auth.login'))

@section('content')
<div class="form-group">
    <label class="form-label" style="font-size:15px">Akreditasi</label>
    <div class="selectgroup w-100">
        <label class="selectgroup-item">
            <input type="radio" name="value" value="50" class="selectgroup-input" checked="">
            <span class="selectgroup-button">A</span>
        </label>
        <label class="selectgroup-item">
            <input type="radio" name="value" value="100" class="selectgroup-input">
            <span class="selectgroup-button">B</span>
        </label>
    </div>
</div>
<div class="form-group">
    <label class="form-label" style="font-size:15px">Minat</label>
    <div class="selectgroup selectgroup-pills">
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="HTML" class="selectgroup-input" checked="">
            <span class="selectgroup-button">Ilmu sosial</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="CSS" class="selectgroup-input">
            <span class="selectgroup-button">Ekonomi, managemen, dan perdagangan</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="PHP" class="selectgroup-input">
            <span class="selectgroup-button">Perencanaan</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="JavaScript" class="selectgroup-input">
            <span class="selectgroup-button">Teknologi Digital</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
            <span class="selectgroup-button">Eksplorasi ide-ide</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
            <span class="selectgroup-button">Budaya, bahasa, sastra</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="C++" class="selectgroup-input">
            <span class="selectgroup-button">Bidang pengetahuan Sains</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="HTML" class="selectgroup-input" checked="">
            <span class="selectgroup-button">Ilmu hukum dan politik</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="CSS" class="selectgroup-input">
            <span class="selectgroup-button">Ilmu psikologi</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="PHP" class="selectgroup-input">
            <span class="selectgroup-button">Ilmu linguistik </span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="JavaScript" class="selectgroup-input">
            <span class="selectgroup-button">Ilmu managemen informasi</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
            <span class="selectgroup-button">Elektroteknik, elektronikan dan komunikasi</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
            <span class="selectgroup-button">Teknologi mesin</span>
        </label>
        <label class="selectgroup-item">
            <input type="checkbox" name="value" value="C++" class="selectgroup-input">
            <span class="selectgroup-button">Arsitektur, teknik sipil, teknik lingkungan</span>
        </label>
    </div>
</div>
<div class="form-group">
    <label class="form-label" style="font-size:15px">Jenis Kelulusan</label>
    <div class="selectgroup w-100">
        <label class="selectgroup-item">
            <input type="radio" name="kelulusan" value="50" class="selectgroup-input" checked="">
            <span class="selectgroup-button">Sekolah Menengah Atas</span>
        </label>
        <label class="selectgroup-item">
            <input type="radio" name="kelulusan" value="100" class="selectgroup-input">
            <span class="selectgroup-button">Sekolah Menengah Kejuruan</span>
        </label>
        <label class="selectgroup-item">
            <input type="radio" name="kelulusan" value="100" class="selectgroup-input">
            <span class="selectgroup-button">Madrasah Aliyah</span>
        </label>
    </div>
</div>
<div class="form-group">
    <label class="form-label" style="font-size:15px">Bahasa</label>
    <div class="selectgroup w-100">
        <label class="selectgroup-item">
            <input type="radio" name="language" value="50" class="selectgroup-input" checked="">
            <span class="selectgroup-button">Saya menguasai 1 Bahasa</span>
        </label>
        <label class="selectgroup-item">
            <input type="radio" name="language" value="100" class="selectgroup-input">
            <span class="selectgroup-button">Saya menguasai 2 Bahasa</span>
        </label>
        <label class="selectgroup-item">
            <input type="radio" name="language" value="100" class="selectgroup-input">
            <span class="selectgroup-button">Saya menguasai lebih dari 2 bahasa</span>
        </label>
    </div>
</div>
<div class="form-group">
    <label class="form-label" style="font-size:15px">Sertifikasi / Pengalaman</label></br>
    <label class="form-label">
        Pernahkah mengikuti ajang kompetisi tingkat SMA/K/MA, atau mengikuti kegiatan sertifikasi lainnya? (Olimpiade,
        LKS, BNSP atau sertifikasi lainnya?
    </label>
    <input type="text" class="form-control inputtags">
</div>
<div class="form-group">
    <label class="form-label" style="font-size:15px">Biaya</label>
    <select class="form-control selectric">
        <option>Kurang dari 1.000.000</option>
        <option>1.000.000 - 1.200.000</option>
        <option>Lebih dari 1.200.000</option>
    </select>
</div>
<div class="form-group">
    <label class="form-label" style="font-size:15px">Kecepatan Kelulusan</label>
    <input type="text" class="form-control">
</div>
<div class="form-group">
    <label class="form-label" style="font-size:15px">Masalah kesehatan</label>
    <select class="form-control selectric">
        <option>Buta Warna</option>
        <option>Tuna Rungu / Wicara</option>
        <option>Anggota tubuh tidak lengkap</option>
        <option>Masalah kesehatan lainnya (tulis)</option>
    </select>
    <textarea class="form-control" style="height:100px"></textarea>
</div>
<div class="form-group">
    <label class="form-label" style="font-size:15px">Akreditasi</label>
    <div class="selectgroup w-100">
        <label class="selectgroup-item">
            <input type="radio" name="bekerja" value="50" class="selectgroup-input" checked="">
            <span class="selectgroup-button">Tidak Bekerja</span>
        </label>
        <label class="selectgroup-item">
            <input type="radio" name="bekerja" value="100" class="selectgroup-input">
            <span class="selectgroup-button">Sudah Bekerja</span>
        </label>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
    integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.statically.io/gh/lcdsantos/jQuery-Selectric/0b92c266/public/jquery.selectric.min.js">
</script>
<script>
    $(".inputtags").tagsinput('items');
</script>
@endsection