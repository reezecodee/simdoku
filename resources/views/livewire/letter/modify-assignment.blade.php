<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="cursor: pointer">
                        <label style="cursor: pointer" class="form-check-label" for="flexCheckDefault">
                            Gunakan tanda tangan digital
                        </label>
                    </div>
                </div>
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
                <p class="letter-format">Tasikmalaya, 20 Oktober 2024</p>
            </div>
            <div class="d-flex justify-content-start">
                <div class="letter-format">
                    <p class="paragraph-height">Kepada Yth.</p>
                    <p class="paragraph-height">Kepala Devisi MER Universitas Bina Sarana Informatika</p>
                    <p class="paragraph-height">
                        <input type="text" class="ml-1 form-control w-50" placeholder="Nama kepala devisi MER">
                    </p>
                    <p class="paragraph-height">di</p>
                    <p class="paragraph-height ml-5" style="letter-spacing: 2px" ><u>JAKARTA</u></p>
                    <p class="paragraph-height d-flex align-items-center">
                        Perihal: 
                        <input type="text" class="ml-1 form-control w-50" placeholder="Masukkan perihal surat tugas">
                    </p>
                    <div class="paragraph-height d-flex align-items-center justify-content-start gap-2 flex-wrap">
                        <span>Berikut kami kirimkan pengajuan Surat Tugas kegiatan</span>
                        <input type="text" class="form-control mx-2 flex-grow-1 w-auto" placeholder="Masukkan nama acara">
                        <span>. Berikut Staf yang akan bertugas:</span>
                    </div>                                      
                </div>
            </div>
            <div class="mt-1">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mb-3">Tambah Staff</button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>Tanggal Pelaksanaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="3">1</td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td rowspan="3"><input type="text" class="form-control"></td>
                            <td rowspan="3">
                                <input type="text" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-1">
                <div class="d-flex align-items-center justify-content-between">
                    <b class="letter-format">Volunteer:</b>
                    <button class="btn btn-primary mb-3">Tambah Volunteer</button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>Tanggal Pelaksanaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="4">1</td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            {{-- buat dinamis --}}
                            <td rowspan="3"><input type="text" class="form-control"></td> 
                            {{-- buat dinamis --}}
                            <td rowspan="3">
                                <input type="text" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>                
            </div>
            <div class="mt-1 letter-format">
                <p>Demikian pengajuan ini kami sampaikan. Atas segala perhatian dan kebijakannya kami mengucapkan terimakasih.</p>
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-center">
                        <div>
                            <p>Koordinator Markom UBSI Tasikmalaya</p>
                            <div class="d-flex justify-content-center">
                                <img width="150" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Tanda_tangan_Arsul_Sani.svg/2560px-Tanda_tangan_Arsul_Sani.svg.png" alt="" srcset="">
                            </div>
                            <p class="paragraph-height"><b>Prof. Budi Budiman, S.T, M.Kom</b></p>
                            <p class="paragraph-height"><b>NIP.29398434234</b></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div>
                            <p>Kepala Kampus UBSI Tasikmalaya</p>
                            <div class="d-flex justify-content-center">
                                <img width="150" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Tanda_tangan_Arsul_Sani.svg/2560px-Tanda_tangan_Arsul_Sani.svg.png" alt="" srcset="">
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