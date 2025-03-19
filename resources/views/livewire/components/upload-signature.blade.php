<div>
    <form wire:submit.prevent="submit">
        <div class="card-body text-center">
            <h5 class="card-title mt-2">Upload Tanda Tangan</h5>
            <p class="card-text text-muted" id="fileName" wire:ignore>Pilih file yang ingin diunggah.</p>
            <div class="mb-3">
                <label for="fileUpload" class="form-label btn btn-primary btn-sm">
                    <i class="bi bi-cloud-upload-fill"></i> Pilih File
                </label>
                <input type="file" wire:model.lazy="tanda_tangan" id="fileUpload" class="form-control d-none">
                <input type="text" wire:model.lazy="nama_pemilik" name="" id="" placeholder="Nama pemilik tanda tangan"
                    class="d-block w-100 form-control mt-2">
                <input type="text" wire:model.lazy="nip" name="" id="" placeholder="NIP"
                    class="d-block w-100 form-control mt-2">
            </div>
            <button type="submit" class="btn btn-success btn-sm w-100" id="uploadButton">
                Unggah
            </button>
        </div>
    </form>
    <script>
        const fileInput = document.getElementById('fileUpload');
            const fileNameDisplay = document.getElementById('fileName');
        
            fileInput.addEventListener('change', () => {
                const file = fileInput.files[0]; 
                if (file) {
                    fileNameDisplay.textContent = file.name;
                } else {
                    fileNameDisplay.innerHTML = '<small class="text-muted">Belum ada file dipilih</small>';
                }
            });
    </script>
</div>