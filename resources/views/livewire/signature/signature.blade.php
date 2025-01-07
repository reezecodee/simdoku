<div>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <select name="" id="" class="d-flex justify-content-start form-control">
                        <option selected>Pilih jabatan</option>
                        <option value="Kadiv DMER">Kadiv DMER</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <h5 class="card-title mt-2">Upload Tanda Tangan</h5>
                    <p class="card-text text-muted" id="fileName">Pilih file yang ingin diunggah.</p>
                    <div class="mb-3">
                        <label for="fileUpload" class="form-label btn btn-primary btn-sm">
                            <i class="bi bi-cloud-upload-fill"></i> Pilih File
                        </label>
                        <input type="file" id="fileUpload" class="form-control d-none">
                        <input type="text" name="" id="" placeholder="Nama pemilik tanda tangan"
                            class="d-block w-100 form-control mt-2">
                    </div>
                    <button class="btn btn-success btn-sm w-100" id="uploadButton">
                        Unggah
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="alert alert-warning">
                Sistem sudah menerapkan auto-save sehingga setiap perubahan akan langsung disimpan ke database.
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Total Tanda Tangan</div>
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="card shadow-sm text-center">
                                <div class="card-body">
                                    <h3 class="mb-1 fw-bold">2</h3>
                                    <p class="text-muted">Kdiv DMER</p>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-md-4">
                            <div class="card shadow-sm text-center">
                                <div class="card-body">
                                    <h3 class="mb-1 fw-bold">2</h3>
                                    <p class="text-muted">Mahasiswa</p>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-md-4">
                            <div class="card shadow-sm text-center">
                                <div class="card-body">
                                    <h3 class="mb-1 fw-bold">2</h3>
                                    <p class="text-muted">Lainnya</p>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <select name="" id="" class="d-flex justify-content-start form-control mb-2">
                        <option selected>Pilih jabatan</option>
                        <option value="Kadiv DMER">Kadiv DMER</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <div class="mb-3">
                        <img src="https://smconsult.co.id/wp-content/uploads/2021/07/wet_digital_signature.jpg" alt=""
                            srcset="" class="w-50">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="text" name="" value="Budi Budiman" id="" class="w-100">
                        <button class="btn btn-danger btn-sm ml-2">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const fileInput = document.getElementById('fileUpload');
            const fileNameDisplay = document.getElementById('fileName');
        
            fileInput.addEventListener('change', () => {
                const file = fileInput.files[0]; // Ambil file pertama yang dipilih
                if (file) {
                    fileNameDisplay.textContent = file.name; // Tampilkan nama file
                } else {
                    fileNameDisplay.innerHTML = '<small class="text-muted">Belum ada file dipilih</small>';
                }
            });
    </script>
</div>