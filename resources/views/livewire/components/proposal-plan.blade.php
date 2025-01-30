<div>
    <div class="form-group">
        <label for="nama-tema-kegiatan" class="form-label"><b>2.1 Nama dan Tema Kegiatan</b></label>
        <x-text-editor.trix title="tema_kegiatan" value="{{ $tema_kegiatan }}"/>
    </div>
    <div class="form-group">
        <label for="deskripsi-kegiatan" class="form-label"><b>2.2 Deskripsi Kegiatan</b></label>
        <x-text-editor.trix title="deskripsi_kegiatan" value="{{ $deskripsi_kegiatan }}"/>
    </div>
    <div class="form-group">
        <label for="penyelenggara-kegiatan" class="form-label"><b>2.3 Penyelenggara Kegiatan</b></label>
        <x-text-editor.trix title="penyelenggara_kegiatan" value="{{ $penyelenggara_kegiatan }}"/>
    </div>
    <div class="form-group">
        <label for="peserta-kegiatan" class="form-label"><b>2.4 Peserta Kegiatan</b></label>
        <x-text-editor.trix title="peserta_kegiatan" value="{{ $peserta_kegiatan }}"/>
    </div>
    <div class="form-group">
        <label for="waktu-pelaksanaan" class="form-label"><b>2.5 Waktu Pelaksanaan</b></label>
        <x-text-editor.trix title="waktu_pelaksanaan" value="{{ $waktu_pelaksanaan }}"/>
    </div>
</div>
