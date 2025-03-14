<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('archive.index') }}" wire:navigate.hover>
                    <button class="btn btn-danger">Kembali</button>
                </a>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="submit">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="form-label">Nama file ZIP</label>
                    <input type="text" class="form-control @error('nama_zip') is-invalid @enderror"
                        wire:model.blur="nama_zip" placeholder="Masukkan nama file ZIP">
                    @error('nama_zip')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                @if($files)
                <div class="row mb-4">
                    @foreach ($files as $index => $file)
                    <div class="col-md-3 mb-3" wire:key="{{ $loop->iteration }}">
                        <div class="text-center">
                            <img src="/images/file.svg" style="cursor: pointer" wire:click="removeFile('{{ $index }}')"
                                width="50" loading="lazy" alt="" srcset="">
                            <span class="d-block">{{ $file->getClientOriginalName() }} <br> ({{ $file->getSize() / 1024
                                }}
                                KB)</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="mb-4">
                    <img id="fileIcon" src="https://www.svgrepo.com/show/529274/upload.svg" width="80"
                        alt="Upload Icon">
                </div>
                <h5 id="fileName" class="card-title fw-bold">
                    Upload file
                </h5>
                <p class="text-muted mb-4">Pilih file dari perangkat Anda untuk diunggah.</p>
                @endif
                <div class="mb-3">
                    <label for="fileInput" class="form-label btn btn-outline-warning px-4 py-2">
                        Pilih File
                    </label>
                    <input type="file" id="fileInput" wire:model.blur="new_files" class="d-none" multiple>
                </div>

                @error('new_files')
                <div id="errorMessage" class="text-danger small">{{ $message }}</div>
                @enderror

                <button id="submitButton" type="submit" class="btn btn-primary w-100">Upload</button>
            </div>
        </div>
    </form>
</div>