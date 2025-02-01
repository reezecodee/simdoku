<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h4 class="card-title">Halaman BAB I PENDAHULUAN</h4>
            </div>
            <div class="form-group">
                <label for="latar-belakang" class="form-label"><b>1.1 Latar Belakang</b></label>
                <x-text-editor.trix title="latar_belakang" value="{{ $latar_belakang }}" />
            </div>
            <div class="form-group">
                <label for="tujuan-kegiatan" class="form-label"><b>1.2 Tujuan Kegiatan</b></label>
                <x-text-editor.trix title="tujuan_kegiatan" value="{{ $tujuan_kegiatan }}" />
            </div>
            <div class="form-group">
                <label for="manfaat-kegiatan" class="form-label"><b>1.3 Manfaat Kegiatan</b></label>
                <x-text-editor.trix title="manfaat_kegiatan" value="{{ $manfaat_kegiatan }}" />
            </div>
            <div class="form-group">
                <label for="indikator-keberhasilan" class="form-label"><b>1.4 Indikator Keberhasilan</b></label>
                <x-text-editor.trix title="indikator_keberhasilan" value="{{ $indikator_keberhasilan }}" />
            </div>
        </div>
    </div>
</div>