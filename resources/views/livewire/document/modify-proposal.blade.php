<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('proposal.index') }}" wire:navigate.hover>
                    <button class="btn btn-danger">Kembali</button>
                </a>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success mr-2">Preview Proposal</button>
                    <button class="btn btn-primary mr-2" wire:click="createWordDocument">Cetak Word</button>
                    <button class="btn btn-danger" wire:click="generatePDF">Cetak PDF</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="judul" class="form-label"><b>Judul Proposal</b></label>
                        <input type="text" wire:model.lazy="judul" id="judul" class="form-control"
                            placeholder="Masukkan judul proposal">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tahun" class="form-label"><b>Tahun</b></label>
                        <input type="number" wire:model.lazy="tahun" id="tahun" class="form-control"
                            placeholder="Masukkan tahun penggunaan proposal">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" wire:ignore>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h4 class="card-title">Halaman Kata Pengantar</h4>
            </div>
            <div class="form-group">
                <label for="kata-pengantar" class="form-label"><b>Kata Pengantar</b></label>
                <textarea id="editor" wire:model.lazy="kata_pengantar">
                </textarea>
            </div>
        </div>
    </div>
    <div class="card" wire:ignore>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h4 class="card-title">Halaman BAB I PENDAHULUAN</h4>
            </div>
            <livewire:components.proposal-intro :id="$id"/>
        </div>
    </div>
    <div class="card" wire:ignore>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h4 class="card-title">Halaman BAB II PERENCANAAN KEGIATAN</h4>
            </div>
            <livewire:components.proposal-plan :id="$id"/>
            <livewire:components.proposal-plan-schedule :id="$id" />
            <livewire:components.proposal-plan-committee :id="$id" />  
            <livewire:components.proposal-plan-budget :id="$id" />  
        </div>
    </div>
    <div class="card" wire:ignore>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h4 class="card-title">Halaman BAB III PENUTUP</h4>
            </div>
            <div class="form-group">
                <label for="peserta-kegiatan" class="form-label"><b>Penutup</b></label>
                <textarea id="editor" wire:model.lazy="penutup">	
                </textarea>
            </div>
            <div class="d-flex justify-content-end">
                <p>Tasikmalaya, 20 Oktober 2024</p>
            </div>
            <div class="d-flex justify-content-start mt-4">
                <p>Hormat kami,</p>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center">
                            <img width="150"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Tanda_tangan_Arsul_Sani.svg/2560px-Tanda_tangan_Arsul_Sani.svg.png"
                                alt="" srcset="">
                        </div>
                        <p class="paragraph-height"><b>Prof. Budi Budiman, S.T, M.Kom</b></p>
                        <p class="paragraph-height"><b>Ketua Panitia</b></p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div>
                        <div class="d-flex justify-content-center">
                            <img width="150"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Tanda_tangan_Arsul_Sani.svg/2560px-Tanda_tangan_Arsul_Sani.svg.png"
                                alt="" srcset="">
                        </div>
                        <p class="paragraph-height"><b>Prof. Budi Budiman, S.T, M.Kom</b></p>
                        <p class="paragraph-height"><b>Kepala Kampus</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>