<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('proposal.index') }}" wire:navigate.hover>
                    <button class="btn btn-danger">Kembali</button>
                </a>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('proposal.preview', $id) }}" target="_blank">
                        <button class="btn btn-success mr-2">Preview Proposal</button>
                    </a>
                    <button class="btn btn-primary mr-2" wire:click="createWordDocument">Cetak Word</button>
                    <button class="btn btn-danger" wire:click="createPDFDocument">Cetak PDF</button>
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
                <x-text-editor.trix title="kata_pengantar" value="{{ $kata_pengantar }}" />
            </div>
        </div>
    </div>
    <div class="card" wire:ignore>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h4 class="card-title">Halaman BAB I PENDAHULUAN</h4>
            </div>
            <livewire:components.proposal-intro :id="$id" />
        </div>
    </div>
    <div class="card" wire:ignore>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h4 class="card-title">Halaman BAB II PERENCANAAN KEGIATAN</h4>
            </div>
            <livewire:components.proposal-plan :id="$id" />
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
                <label for="penutup" class="form-label"><b>Penutup</b></label>
                <x-text-editor.trix title="penutup" value="{{ $penutup }}" />
            </div>
            <div class="d-flex justify-content-end">
                <p>Tasikmalaya, {{ $date }}</p>
            </div>
            <div class="d-flex justify-content-start mt-4">
                <p>Hormat kami,</p>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-center">
                    <livewire:components.select-signature type="Ketua Panitia" doc="proposal"
                        signature="ttd_ketua_panitia_id" function-name="SignatureLeadCommittee" :id="$id" />
                </div>
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <p>Kepala Kampus UBSI Tasikmalaya</p>
                        @if($user)
                        <div class="d-flex justify-content-center">
                            <img width="150" src="{{ asset('storage/'.$user->tanda_tangan) }}" alt="" srcset="">
                        </div>
                        <p class="paragraph-height"><b>{{ $user->nama }}</b></p>
                        <p class="paragraph-height"><b>NIP.{{ $user->nip }}</b></p>
                        @else
                        <div class="d-flex justify-content-center">
                            <p>Belum diatur</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>