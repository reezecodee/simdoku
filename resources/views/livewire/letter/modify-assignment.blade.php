<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-end">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success mr-2">Preview Surat</button>
                    <button class="btn btn-primary mr-2">Cetak Word</button>
                    <button class="btn btn-danger">Cetak PDF</button>
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
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mb-3" wire:click="addStaff(0)">Tambah Staff</button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sekolah</th>
                            <th>Tanggal pelaksanaan</th>
                            <th>NIP</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($executions as $index => $execution)
                        <tr>
                            <td rowspan="{{ max(1, count($execution['staff'])) + 1 }}">{{ $loop->iteration }}</td>
                            <td rowspan="{{ max(1, count($execution['staff'])) + 1 }}">
                                <input type="text" class="form-control"
                                    wire:model.debounce.500ms="executions.{{ $index }}.nama_sekolah"
                                    placeholder="Nama Sekolah">
                            </td>
                            <td rowspan="{{ max(1, count($execution['staff'])) + 1 }}">
                                <input type="date" class="form-control"
                                    wire:model.debounce.500ms="executions.{{ $index }}.tgl_pelaksanaan">
                            </td>
                        </tr>
                        @if (count($execution['staff']) > 0)
                        @foreach ($execution['staff'] as $staffIndex => $staff)
                        <tr>
                            <td>
                                <input type="text" class="form-control"
                                    wire:model.debounce.500ms="executions.{{ $index }}.staff.{{ $staffIndex }}.nip"
                                    placeholder="NIP">
                            </td>
                            <td>
                                <input type="text" class="form-control"
                                    wire:model.debounce.500ms="executions.{{ $index }}.staff.{{ $staffIndex }}.nama"
                                    placeholder="Nama">
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="2" class="text-center">Tidak ada staff</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-1">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mb-3" wire:click="addVolunteer(0)">Tambah Volunteer</button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sekolah</th>
                            <th>Tanggal pelaksanaan</th>
                            <th>NIM</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($executions as $index => $execution)
                        <tr>
                            <td rowspan="{{ max(1, count($execution['volunteers'])) + 1 }}">{{ $loop->iteration }}</td>
                            <td rowspan="{{ max(1, count($execution['volunteers'])) + 1 }}">
                                <input type="text" class="form-control"
                                    wire:model.debounce.500ms="executions.{{ $index }}.nama_sekolah"
                                    placeholder="Nama Sekolah">
                            </td>
                            <td rowspan="{{ max(1, count($execution['volunteers'])) + 1 }}">
                                <input type="date" class="form-control"
                                    wire:model.debounce.500ms="executions.{{ $index }}.tgl_pelaksanaan">
                            </td>
                        </tr>
                        @if (count($execution['volunteers']) > 0)
                        @foreach ($execution['volunteers'] as $volunteerIndex => $volunteer)
                        <tr>
                            <td>
                                <input type="text" class="form-control"
                                    wire:model.debounce.500ms="executions.{{ $index }}.volunteers.{{ $volunteerIndex }}.nim"
                                    placeholder="NIM">
                            </td>
                            <td>
                                <input type="text" class="form-control"
                                    wire:model.debounce.500ms="executions.{{ $index }}.volunteers.{{ $volunteerIndex }}.nama"
                                    placeholder="Nama">
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="2" class="text-center">Tidak ada volunteer</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-1 letter-format">
                <p>Demikian pengajuan ini kami sampaikan. Atas segala perhatian dan kebijakannya kami mengucapkan
                    terimakasih.</p>
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-center">
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