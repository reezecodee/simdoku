<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">{{ $total }}</h3>
                            <p class="text-muted">Total File ZIP</p>
                        </div>
                        <a href="{{ route('archive.upload') }}" wire:navigate.hover>
                            <button class="btn btn-primary">Upload File</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <span class="mb-2 d-block fw-bold">Pencarian cepat</span>
                    <div class="d-flex align-items-center">
                        <input type="search" wire:model.lazy="search" class="form-control mr-2"
                            placeholder="Cari arsip file...">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($archives->isNotEmpty())
    <div class="row mb-5">
        @foreach ($archives as $item)
        <div wire:key="{{ $item->id }}" class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="d-flex justify-content-end">
                        <a href="{{ asset('storage/'.$item->file_zip) }}" download>
                            <button class="btn btn-success">Download</button>
                        </a>
                    </div>
                    <div class="mb-3">
                        <img src="/images/folder.svg" alt="" srcset="" class="w-50" loading="lazy">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="text"
                            wire:input.debounce.1000ms="updateNamaZip('{{ $item->id }}', 'nama_zip', $event.target.value)"
                            value="{{ $item->nama_zip }}" id="" class="w-100">
                        <button wire:click="deleteFileZip('{{ $item->id }}')" class="btn btn-danger btn-sm ml-2">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-end">
        {{ $archives->links() }}
    </div>
    @else
    <div class="mb-5">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('svgicon/empty.svg') }}" width="100" alt="" srcset="">
        </div>
        <p class="text-center">Tidak dapat menemukan file arsip.</p>
    </div>
    @endif
</div>