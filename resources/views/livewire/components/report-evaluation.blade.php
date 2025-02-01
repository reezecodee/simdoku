<div>
    <label for="jumlah-peserta" class="form-label d-block">1. Jumlah Peserta</label>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="peserta-daftar" class="form-label">a. Jumlah Peserta Daftar</label>
                <input type="text" class="form-control" wire:model.lazy="peserta_daftar" placeholder="Jumlah peserta daftar">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="peserta-hadir" class="form-label">b. Jumlah Peserta Hadir</label>
                <input type="text" class="form-control" wire:model.lazy="peserta_hadir" placeholder="Jumlah peserta hadir">
            </div>
        </div>
    </div>
    <label for="kepuasan-peserta" class="form-label d-block">2. Kepuasan Peserta</label>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="peserta-puas" class="form-label">a. Jumlah Peserta Puas</label>
                <input type="text" class="form-control" wire:model.lazy="peserta_puas" placeholder="Jumlah peserta puas">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="peserta-hadir" class="form-label">b. Jumlah Peserta Cukup Puas</label>
                <input type="text" class="form-control" wire:model.lazy="peserta_cukup_puas" placeholder="Jumlah peserta cukup puas">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="peserta-tidak-puas" class="form-label">c. Jumlah Peserta Tidak Puas</label>
                <input type="text" class="form-control" wire:model.lazy="peserta_tidak_puas" placeholder="Jumlah peserta tidak puas">
            </div>
        </div>
    </div>
    <label for="kepuasan-peserta" class="form-label d-block">3. Penilaian Tentang Acara</label>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="penilaian-sangat-bagus" class="form-label">a. Jumlah Penilaian Sangat
                    Bagus</label>
                <input type="text" class="form-control" wire:model.lazy="penilaian_sangat_bagus" placeholder="Jumlah penilaian sangat bagus">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="penilaian-cukup-bagus" class="form-label">b. Jumlah Penilaian Cukup
                    Bagus</label>
                <input type="text" class="form-control" wire:model.lazy="penilaian_cukup_bagus" placeholder="Jumlah penilaian cukup bagus">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="penilaian-kurang-bagus" class="form-label">c. Jumlah Penilaian Kurang
                    Bagus</label>
                <input type="text" class="form-control" wire:model.lazy="penilaian_kurang_bagus" placeholder="Jumlah penilaian kurang bagus">
            </div>
        </div>
    </div>
</div>