<div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <button wire:click="downloadPDF" class="btn btn-success mr-2"><i class="fas fa-file-pdf"></i> Download
                        PDF</button>
                    <button wire:click="downloadWord" class="btn btn-primary mr-2"><i class="fas fa-file-word"></i>
                        Download Word</button>
                    <a href="{{ route('letter.assignment') }}" wire:navigate.hover>
                        <button class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-label">Kepala Divisi MER Universitas BSI</label>
                            <input placeholder="Masukkan nama kepala divisi MER" type="text" class="form-control"
                                wire:model.live.debounce.500ms="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-label">Perihal surat</label>
                            <input placeholder="Masukkan perihal surat" type="text" class="form-control"
                                wire:model.live.debounce.500ms="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="form-label">Kegiatan tugas</label>
                            <input placeholder="Masukkan kegiatan tugas" type="text" class="form-control"
                                wire:model.live.debounce.500ms="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <b>Staff yang akan bertugas</b>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>Tanggal pelaksanaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="number" wire:model.live.debounce.500ms class="form-control"
                                    placeholder="NIP staff">
                            </td>
                            <td>
                                <input type="text" wire:model.live.debounce.500ms class="form-control"
                                    placeholder="Nama staff">
                            </td>
                            <td rowspan="3">
                                <textarea cols="30" rows="10" wire:model.live.debounce.500ms="" class="form-control"
                                    placeholder="Nama sekolah"></textarea>
                            </td>
                            <td rowspan="3">
                                <textarea cols="30" rows="10" wire:model.live.debounce.500ms="" class="form-control"
                                    placeholder="Hari, tanggal, dan jam"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="number" wire:model.live.debounce.500ms class="form-control"
                                    placeholder="NIP staff">
                            </td>
                            <td>
                                <input type="text" wire:model.live.debounce.500ms class="form-control"
                                    placeholder="Nama staff">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <b>Volunteer yang akan bertugas</b>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>Tanggal pelaksanaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="number" wire:model.live.debounce.500ms class="form-control"
                                    placeholder="NIP staff">
                            </td>
                            <td>
                                <input type="text" wire:model.live.debounce.500ms class="form-control"
                                    placeholder="Nama staff">
                            </td>
                            <td rowspan="3">
                                <textarea cols="30" rows="10" wire:model.live.debounce.500ms="" class="form-control"
                                    placeholder="Nama sekolah"></textarea>
                            </td>
                            <td rowspan="3">
                                <textarea cols="30" rows="10" wire:model.live.debounce.500ms="" class="form-control"
                                    placeholder="Hari, tanggal, dan jam"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>
                                <input type="number" wire:model.live.debounce.500ms class="form-control"
                                    placeholder="NIP staff">
                            </td>
                            <td>
                                <input type="text" wire:model.live.debounce.500ms class="form-control"
                                    placeholder="Nama staff">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
