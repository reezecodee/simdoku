<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h4 class="card-title">Halaman BAB II PELAKSANAAN KEGIATAN</h4>
            </div>
            <div class="form-group">
                <label for="nama-tema-kegiatan" class="form-label"><b>2.1 Nama dan Tema Kegiatan</b></label>
                <x-text-editor.trix title="tema_kegiatan" value="{{ $tema_kegiatan }}" />
            </div>
            <div class="form-group">
                <label for="deskripsi-kegiatan" class="form-label"><b>2.2 Deskripsi Kegiatan</b></label>
                <x-text-editor.trix title="deskripsi_kegiatan" value="{{ $deskripsi_kegiatan }}" />
            </div>
            <div class="form-group">
                <label for="penyelenggara-kegiatan" class="form-label"><b>2.3 Penyelenggara Kegiatan</b></label>
                <x-text-editor.trix title="penyelenggara_kegiatan" value="{{ $penyelenggara_kegiatan }}" />
            </div>
            <div class="form-group">
                <label for="pemateri-atau-narasumber" class="form-label"><b>2.4 Pemateri atau Narasumber</b></label>
                <x-text-editor.trix title="pemateri_narasumber" value="{{ $pemateri_narasumber }}" />
            </div>
            <div class="form-group">
                <label for="peserta-kegiatan" class="form-label"><b>2.5 Peserta Kegiatan</b></label>
                <x-text-editor.trix title="peserta_kegiatan" value="{{ $peserta_kegiatan }}" />
            </div>
            <div class="form-group">
                <label for="waktu-pelaksanaan" class="form-label"><b>2.6 Waktu Pelaksanaan</b></label>
                <x-text-editor.trix title="waktu_pelaksanaan" value="{{ $waktu_pelaksanaan }}" />
            </div>
            <div class="form-group">
                <label for="evaluasi-kegiatan" class="form-label"><b>2.7 Evaluasi Kegiatan</b></label>
                <livewire:components.report-evaluation :id="$id"/>
            </div>
            <div class="form-group">
                <label for="susunan-acara" class="form-label"><b>2.8 Susunan Acara</b></label>
                <livewire:components.report-schedule :id="$id"/>
            </div>
            <div class="form-group">
                <label for="susunan-panitia" class="form-label"><b>2.9 Susunan Panitia</b></label>
                <livewire:components.report-committee :id="$id"/>
            </div>
            <div class="form-group">
                <label for="realisasi-anggaran" class="form-label"><b>Realisasi Anggaran</b></label>
                <livewire:components.report-budget-realization :id="$id"/>
            </div>
        </div>
    </div>
</div>