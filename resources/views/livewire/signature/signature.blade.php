<div>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <livewire:components.upload-signature />
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
                                    <h3 class="mb-1 fw-bold">{{ $total }}</h3>
                                    <p class="text-muted">Total Tanda Tangan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <span class="mb-2 d-block fw-bold">Pencarian cepat</span>
                                    <div class="d-flex align-items-center">
                                        <input type="search" wire:model.lazy="search" class="form-control mr-2"
                                            placeholder="Cari tanda tangan...">
                                        <button class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($signatures->isNotEmpty())
    <div class="row mb-5">
        @foreach ($signatures as $item)
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <select wire:change="updateStatus('{{ $item->id }}', 'status', $event.target.value)" class="d-flex justify-content-start form-control mb-2">
                        <option selected value="{{ $item->status }}">{{ $item->status }}</option>
                        <option value="Koordinator Markom">Koordinator Markom</option>
                        <option value="KA. Divisi MER">KA. Divisi MER</option>
                        <option value="KA. BAKU">KA. BAKU</option>
                        <option value="Ketua Panitia">Ketua Panitia</option>
                        <option value="Ketua Pelaksana">Ketua Pelaksana</option>
                    </select>
                    <div class="mb-3">
                        <img src="{{ asset('storage/'.$item->tanda_tangan) }}" alt="" srcset="" class="w-50"
                            loading="lazy">
                    </div>
                    <input type="text" wire:input="updateDataPemilik('{{ $item->id }}', 'nama_pemilik', $event.target.value)" value="{{ $item->nama_pemilik }}" id="" class="w-100 mb-2" placeholder="Nama pemilik">
                    <div class="d-flex justify-content-end">
                        <input type="text" wire:input="updateDataPemilik('{{ $item->id }}', 'nip', $event.target.value)" value="{{ $item->nip }}" id="" class="w-100" placeholder="NIP pemilik">
                        <button wire:click="deleteSignature('{{ $item->id }}')" class="btn btn-danger btn-sm ml-2">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        {{ $signatures->links() }}
    </div>
    @else
    <div class="mb-5">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('svgicon/empty.svg') }}" width="100" alt="" srcset="">
        </div>
        <p class="text-center">Tidak dapat menemukan tanda tangan.</p>
    </div>
    @endif
</div>