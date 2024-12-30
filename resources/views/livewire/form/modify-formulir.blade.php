<div>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="judul-formulir"><b>Judul Formulir</b></label>
                <input type="text" class="form-control" placeholder="Masukkan judul formulir">
            </div>
            <p>Diminta oleh:</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Kampus</b></label>
                        <input type="text" class="form-control" placeholder="Masukkan nama kampus">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Hari/Tgl. Pengajuan</b></label>
                        <input type="text" class="form-control" placeholder="Masukkan tanggal pengajuan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Pemohon</b></label>
                        <input type="text" class="form-control" placeholder="Masukkan nama pemohon">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Unit Kerja</b></label>
                        <input type="text" class="form-control" placeholder="Masukkan unit kerja">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>No. Rekening Bank</b></label>
                        <input type="text" class="form-control" placeholder="Masukkan nomor rekening bank">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Atas Nama Rekening</b></label>
                        <input type="text" class="form-control" placeholder="Masukkan atas nama rekening">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Tanggal Diperlukan</b></label>
                        <input type="text" class="form-control" placeholder="Masukkan tanggal diperlukan">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-2">
                <button class="btn btn-primary">Tambah Pengajuan</button>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan Pengajuan Dana</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <input type="text" wire:model.live.debounce.500ms class="form-control">
                        </td>
                        <td>
                            <input type="text" wire:model.live.debounce.500ms class="form-control">
                        </td>
                        <td>
                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Total Dana Dibutuhkan:</b></td>
                        <td style="text-align: right">
                            <span id="totalTotal"><b>Rp. 0</b></span> 
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Terbilang:</b></td>
                        <td style="text-align: right">
                            <span><b>#Enam Ratus Dua Puluh Lima Rupiah#</b></span> 
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-center">
                    <div>
                        <p class="text-center">Menyetujui,</p>
                        <p class="text-center">KA. Divisi MER</p>
                        <div class="d-flex justify-content-center">
                            <img width="150" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Tanda_tangan_Arsul_Sani.svg/2560px-Tanda_tangan_Arsul_Sani.svg.png" alt="" srcset="">
                        </div>
                        <p class="paragraph-height text-center">(Prof. Budi Budiman, S.T, M.Kom)</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <p class="text-center">Pemohon,</p>
                        <p class="text-center">Kepala Kampus UBSI Kampus Tasikmalaya</p>
                        <div class="d-flex justify-content-center">
                            <img width="150" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Tanda_tangan_Arsul_Sani.svg/2560px-Tanda_tangan_Arsul_Sani.svg.png" alt="" srcset="">
                        </div>
                        <p class="paragraph-height text-center">(Prof. Budi Budiman, S.T, M.Kom)</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <p class="text-center">Mengetahui,</p>
                        <p class="text-center">KA. BAKU</p>
                        <div class="d-flex justify-content-center">
                            <img width="150" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Tanda_tangan_Arsul_Sani.svg/2560px-Tanda_tangan_Arsul_Sani.svg.png" alt="" srcset="">
                        </div>
                        <p class="paragraph-height text-center">(Prof. Budi Budiman, S.T, M.Kom)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
