<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul" class="form-label"><b>Judul laporan</b></label>
                        <input type="text" wire:model.lazy="judul" id="judul" class="form-control" placeholder="Masukkan judul laporan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kutipan" class="form-label"><b>Kutipan</b></label>
                        <input type="text" wire:model.lazy="kutipan" id="kutipan" class="form-control" placeholder="Masukkan kutipan">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h4 class="card-title">Halaman Kata Pengantar</h4>
            </div>
            <div class="form-group">
                <label for="kata-pengantar" class="form-label"><b>Kata Pengantar</b></label>
                <x-text-editor.trix title="kata_pengantar" value="{{ $kata_pengantar }}"/>
            </div>
        </div>
    </div>
    <livewire:components.report-intro :id="$id"/>
    <livewire:components.report-plan-activity :id="$id" />
    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h4 class="card-title">Halaman BAB III PENUTUP</h4>
            </div>
            <div class="form-group">
                <label for="penutup" class="form-label"><b>Penutup</b></label>
                <x-text-editor.trix title="penutup" value="{{ $penutup }}"/>
            </div>
            <div class="mt-1 letter-format">
                <p class="text-center">Tasikmalaya, 28 Agustus 2024</p>
                <p class="text-center">Hormat Kami,</p>
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-center">
                        <div>
                            <p class="text-center">Mengetahui,</p>
                            <div class="d-flex justify-content-center">
                                <img width="150" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Tanda_tangan_Arsul_Sani.svg/2560px-Tanda_tangan_Arsul_Sani.svg.png" alt="" srcset="">
                            </div>
                            <p class="paragraph-height text-center"><u>Prof. Budi Budiman, S.T, M.Kom</u></p>
                            <p class="paragraph-height text-center"><b>Kepala Kampus UBSI Tasikmalaya</b></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <livewire:components.select-signature type="Ketua Pelaksana" doc="report" signature="ttd_ketua_pelaksana" function-name="SignatureChiefExecutive" :id="$id"/>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <livewire:components.select-signature type="KA. Divisi MER" doc="report" signature="ttd_kdiv_dmer" function-name="SignatureKaDivMER" :id="$id"/>
                </div>
            </div>
        </div>
    </div>
</div>
