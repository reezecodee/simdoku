<div>
    <div class="form-group">
        <label for="latar-belakang" class="form-label"><b>1.1 Latar Belakang</b></label>
        <x-text-editor.trix title="latar_belakang" value="{{ $latar_belakang }}"/>
    </div>
    <div class="form-group">
        <label for="tujuan-kegiatan" class="form-label"><b>1.2 Tujuan Kegiatan</b></label>
        <x-text-editor.trix title="tujuan_kegiatan" value="{{ $tujuan_kegiatan }}"/>
    </div>
    <div class="form-group">
        <label for="indikator-keberhasilan" class="form-label"><b>1.3 Indikator Keberhasilan</b></label>
        <x-text-editor.trix title="indikator_keberhasilan" value="{{ $indikator_keberhasilan }}"/>
    </div>
</div>
