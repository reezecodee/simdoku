<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('letter.index') }}" wire:navigate.hover>
                    <button class="btn btn-danger">Kembali</button>
                </a>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success mr-2">Preview Surat</button>
                    <button class="btn btn-primary mr-2">Cetak Word</button>
                    <button class="btn btn-danger" wire:click="generatePdf">Cetak PDF</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <p class="letter-format">Tasikmalaya, {{ $date }}</p>
            </div>
            <div class="d-flex justify-content-start">
                <div class="letter-format">
                    <p class="paragraph-height">Kepada Yth.</p>
                    <p class="paragraph-height">Kepala Devisi MER Universitas Bina Sarana Informatika</p>
                    <p class="paragraph-height">
                        <input type="text" wire:model.blur="kepala_devisi_mer" class="ml-1 form-control w-50"
                            placeholder="Nama kepala devisi MER">
                    </p>
                    <p class="paragraph-height">di</p>
                    <p class="paragraph-height ml-5" style="letter-spacing: 2px"><u>JAKARTA</u></p>
                    <p class="paragraph-height d-flex align-items-center">
                        Perihal:
                        <input type="text" wire:model.blur="perihal" class="ml-1 form-control w-50"
                            placeholder="Masukkan perihal surat tugas">
                    </p>
                    <div class="paragraph-height d-flex align-items-center justify-content-start gap-2 flex-wrap">
                        <span>Berikut kami kirimkan pengajuan Surat Tugas kegiatan</span>
                        <input type="text" wire:model.blur="nama_acara" class="form-control mx-2 flex-grow-1 w-auto"
                            placeholder="Masukkan nama acara">
                        <span>. Berikut Staf yang akan bertugas:</span>
                    </div>
                </div>
            </div>

            <div class="mt-1">
                <livewire:components.staff-table :letter-id="$id" :first-id-execution="$firstIdExecutionStaff" />
            </div>

            <div class="mt-1">
                <livewire:components.volunteer-table :letter-id="$id"
                    :first-id-execution="$firstIdExecutionVolunteer" />
            </div>


            <div class="mt-1 letter-format">
                <p>Demikian pengajuan ini kami sampaikan. Atas segala perhatian dan kebijakannya kami mengucapkan
                    terimakasih.</p>
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-center">
                        @if($letter->ttd_markom_id)
                        <div>
                            <p>Koordinator Markom UBSI Tasikmalaya</p>
                            <div class="d-flex justify-content-center">
                                <img width="150"
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Tanda_tangan_Arsul_Sani.svg/2560px-Tanda_tangan_Arsul_Sani.svg.png"
                                    alt="" srcset="">
                            </div>
                            <p class="paragraph-height"><b>Prof. Budi Budiman, S.T, M.Kom</b></p>
                            <p class="paragraph-height"><b>NIP.29398434234</b></p>
                        </div>
                        @else
                        <div>
                            <p>Koordinator Markom UBSI Tasikmalaya</p>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-danger trigger--fire-modal-7" data-confirm="Realy?|Do you want to continue?" data-confirm-yes="alert('Deleted :)');">Delete</button>
                                {{-- <button type="button" class="btn btn-primary btn-sm trigger--fire-modal-7"
                                    id="modal-1">Pilih tanda tangan</button> --}}
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center">
                        <div>
                            <p>Kepala Kampus UBSI Tasikmalaya</p>
                            <div class="d-flex justify-content-center">
                                <img width="150"
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Tanda_tangan_Arsul_Sani.svg/2560px-Tanda_tangan_Arsul_Sani.svg.png"
                                    alt="" srcset="">
                            </div>
                            <p class="paragraph-height"><b>Prof. Budi Budiman, S.T, M.Kom</b></p>
                            <p class="paragraph-height"><b>NIP.29398434234</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <livewire:components.signature-modal" />
    
</div>