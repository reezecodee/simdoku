<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('scholarship.index') }}" wire:navigate.hover>
                    <button class="btn btn-danger">Kembali</button>
                </a>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('scholarship.statistic', $id) }}" target="_blank">
                        <button class="btn btn-success mr-2">Lihat Statistik</button>
                    </a>
                    <button class="btn btn-primary mr-2" wire:click="downloadExcel">Download Sebagai Excel</button>
                    <a href="{{ asset('documents/format.xlsx') }}" download>
                        <button class="btn btn-warning mr-2">Download Format</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama" class="form-label"><b>Nama Beasiswa</b></label>
                        <input type="text" wire:model.lazy="nama" id="nama" class="form-control"
                            placeholder="Masukkan nama beasiswa">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="periode" class="form-label"><b>Periode</b></label>
                        <input type="text" wire:model.lazy="periode" id="periode" class="form-control"
                            placeholder="Masukkan periode beasiswa">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tahun" class="form-label"><b>Tahun Beasiswa</b></label>
                        <input type="number" wire:model.lazy="tahun" id="tahun" class="form-control"
                            placeholder="Masukkan tahun beasiswa">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <livewire:components.student-table :id="$id" />
        </div>
    </div>
</div>