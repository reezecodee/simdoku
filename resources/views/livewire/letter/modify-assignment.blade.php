<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('letter.index') }}" wire:navigate.hover>
                    <button class="btn btn-danger">Kembali</button>
                </a>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('letter.preview', $id) }}" target="_blank">
                        <button class="btn btn-success mr-2">Preview Surat</button>
                    </a>
                    <button class="btn btn-primary mr-2" wire:click="printWord">Cetak Word</button>
                    <button class="btn btn-danger" wire:click="printPDF">Cetak PDF</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <p class="letter-format">Tasikmalaya, {{ $today }}</p>
            </div>
            <livewire:components.header-letter :id="$id" />

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
                        <livewire:components.select-signature type="Koordinator Markom" doc="letter"
                            signature="ttd_markom_id" function-name="SignatureMarkom" :id="$id" />
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
</div>