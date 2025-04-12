<div>
    <div wire:loading wire:target="exportExcel" class="loading-overlay">
        <div class="spinner"></div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('form.index') }}" wire:navigate.hover>
                    <button class="btn btn-danger">Kembali</button>
                </a>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success" wire:click="exportExcel">Cetak Excel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="judul-formulir"><b>Judul Formulir</b></label>
                <input wire:model.lazy="judul" type="text" class="form-control" placeholder="Masukkan judul formulir">
            </div>
            <p>Diminta oleh:</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Tgl. Pengajuan</b></label>
                        <input wire:model.lazy="tgl_pengajuan" type="date" class="form-control" placeholder="Masukkan tanggal pengajuan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Pemohon</b></label>
                        <input wire:model.lazy="pemohon" type="text" class="form-control" placeholder="Masukkan nama pemohon">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Unit Kerja</b></label>
                        <input wire:model.lazy="unit_kerja" type="text" class="form-control" placeholder="Masukkan unit kerja">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>No. Rekening Bank</b></label>
                        <input wire:model.lazy="no_rekening" type="text" class="form-control" placeholder="Masukkan nomor rekening bank">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Atas Nama Rekening</b></label>
                        <input wire:model.lazy="atas_nama" type="text" class="form-control" placeholder="Masukkan atas nama rekening">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kampus"><b>Tanggal Diperlukan</b></label>
                        <input wire:model.lazy="tgl_diperlukan" type="date" class="form-control" placeholder="Masukkan tanggal diperlukan">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-2">
                <button class="btn btn-primary" wire:click="addBudget">Tambah Pengajuan</button>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan Pengajuan Dana</th>
                        <th>Jumlah Dana</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgets as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <input type="text" wire:input="updateBudget('{{ $item->id }}', 'keterangan', $event.target.value)" class="form-control" value="{{ $item->keterangan }}">
                        </td>
                        <td>
                            <input type="number" wire:input="updateBudget('{{ $item->id }}', 'jumlah', $event.target.value)" class="form-control" value="{{ $item->jumlah }}">
                        </td>
                        <td>
                            <button class="btn btn-danger" wire:click="deleteBudget('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2"><b>Total Dana Dibutuhkan:</b></td>
                        <td style="text-align: right">
                            <span id="totalTotal"><b>{{ idr($total) }}</b></span> 
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Terbilang:</b></td>
                        <td style="text-align: right">
                            <span><b>#{{ $terbilang }} Rupiah#</b></span> 
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
                    <livewire:components.signature-formulir :id="$id" as="Menyetujui" position="KA. Divisi MER" function-name="KaDivMER" signature="ttd_ka_devisi_mer"/>
                </div>
                <div class="d-flex justify-content-center">
                    <livewire:components.signature-formulir :id="$id" as="Mengetahui" position="KA. BAKU" function-name="KaBaku" signature="ttd_ka_baku" relation="signature2"/>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <p class="text-center">Pemohon,</p>
                        <p class="text-center">Kepala Kampus UBSI Kampus Tasikmalaya</p>
                        @if($user)
                        <div class="d-flex justify-content-center">
                            <img width="150" src="{{ asset('storage/'.$user->tanda_tangan) }}" alt="" srcset="">
                        </div>
                        @else
                        <p class="paragraph-height text-center">({{ $user->nama }})</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
