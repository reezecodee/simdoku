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
            <livewire:components.header-letter :id="$id"/>

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
                        <livewire:components.select-signature type="Koordinator Markom" :id="$id"/>
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
</div>