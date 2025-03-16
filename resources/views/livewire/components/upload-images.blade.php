<div>
    <form wire:submit.prevent="submit" enctype="multipart/form-data">
        <div class="border p-4 text-center rounded" style="cursor: pointer; position: relative;"
            ondragover="event.preventDefault()" ondrop="handleDrop(event)"
            onclick="document.getElementById('{{ $type }}FileInput').click()">
            <img src="/images/file.svg" class="mb-2" width="100" loading="lazy">
            <p class="text-muted">Klik untuk Upload Gambar</p>
            <input type="file" id="{{ $type }}FileInput" wire:model.defer="images" accept="image/png, image/jpeg"
                multiple class="d-none">
        </div>

        <div class="mt-3 d-flex flex-wrap" style="gap: 0.75rem">
            @foreach ($uploadedImages[$type] as $index => $image)
            <div class="border rounded p-1" style="width: 100px; height: 100px; position: relative;">
                <img src="{{ $image['url'] }}" class="w-100 h-100 rounded" style="object-fit: cover;" loading="lazy">
                <button type="button" class="btn btn-danger btn-sm" wire:click="removeImage({{ $index }})"
                    style="position: absolute; top: 5px; right: 5px; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 14px; padding: 0;">
                    &times;
                </button>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-3">Upload</button>
        </div>

        @error('images.*')
        <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </form>

    @if (session()->has('message'))
    <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif
</div>

<script>
    function handleDrop(event) {
        event.preventDefault();
        let fileInput = document.getElementById('{{ $type }}FileInput');
        let files = event.dataTransfer.files;

        let dataTransfer = new DataTransfer();
        for (let i = 0; i < files.length; i++) {
            dataTransfer.items.add(files[i]);
        }

        fileInput.files = dataTransfer.files;
        fileInput.dispatchEvent(new Event('input', { bubbles: true }));
    }
</script>