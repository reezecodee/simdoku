<div>
    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <div class="border p-4 text-center rounded" style="cursor: pointer"
            ondragover="event.preventDefault()" ondrop="handleDrop(event)"
            onclick="document.getElementById('fileInput').click()">
            <img src="/svgicon/file-upload.svg" class="mb-2" width="100" loading="lazy">
            <p class="text-muted">Drag & Drop atau Klik untuk Upload</p>
            <input type="file" id="fileInput" wire:model="images" accept="image/png, image/jpeg" multiple
                class="d-none">
        </div>

        <div class="mt-3 d-flex flex-wrap" style="gap: 0.75rem">
            @foreach ($uploadedImages as $index => $image)
            <div class="border rounded p-1" style="width: 100px; height: 100px; position: relative;" wire:key="dokumentasi-{{ $index }}">
                <img src="{{ $image->temporaryUrl() }}" class="w-100 h-100 rounded" style="object-fit: cover;" loading="lazy">
                <button type="button" class="btn btn-danger btn-sm" wire:click="removeImage({{ $index }})"
                    style="position: absolute; top: 5px; right: 5px; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 14px; padding: 0;">
                    &times;
                </button>
            </div>
            @endforeach
        </div>

        @error('images.*')
        <div class="text-danger mt-2">{{ $message }}</div>
        @enderror

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-3">Upload</button>
        </div>
    </form>

    @if (session()->has('message'))
    <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif
</div>

<script>
    function handleDrop(event) {
        event.preventDefault();
        document.getElementById('fileInput').files = event.dataTransfer.files;
    }
</script>