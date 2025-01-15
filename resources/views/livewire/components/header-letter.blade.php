<div>
    <div class="d-flex justify-content-start">
        <div class="letter-format">
            <p class="paragraph-height">Kepada Yth.</p>
            <p class="paragraph-height">Kepala Devisi MER Universitas Bina Sarana Informatika</p>
            <p class="paragraph-height">
                <input type="text" wire:model.live="kepala_devisi_mer" class="ml-1 form-control w-50"
                    placeholder="Nama kepala devisi MER">
            </p>
            <p class="paragraph-height">di</p>
            <p class="paragraph-height ml-5" style="letter-spacing: 2px"><u>JAKARTA</u></p>
            <p class="paragraph-height d-flex align-items-center">
                Perihal:
                <input type="text" wire:model.live="perihal" class="ml-1 form-control w-50"
                    placeholder="Masukkan perihal surat tugas">
            </p>
            <div class="paragraph-height d-flex align-items-center justify-content-start gap-2 flex-wrap">
                <span>Berikut kami kirimkan pengajuan Surat Tugas kegiatan</span>
                <input type="text" wire:model.live="nama_acara"
                    class="form-control mx-2 flex-grow-1 w-auto" placeholder="Masukkan nama acara">
                <span>. Berikut Staf yang akan bertugas:</span>
            </div>
        </div>
    </div>
</div>
