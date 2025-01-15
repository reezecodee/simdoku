<div>
    @if($letter->ttd_markom_id)
    <div>
        <p>Koordinator Markom UBSI Tasikmalaya</p>
        <div class="d-flex justify-content-center">
            <img width="150"
                src="{{ asset('storage/'.$letter->signature->tanda_tangan) }}"
                alt="" srcset="">
        </div>
        <p class="paragraph-height"><b>{{ $letter->signature->nama_pemilik }}</b></p>
        <p class="paragraph-height"><b>NIP.29398434234</b></p>
    </div>
    @endif
    <div>
        <div class="d-flex justify-content-center">
            <select class="form-control" wire:change="updateSignatureMarkom('ttd_markom_id', $event.target.value)" id="">
                <option selected>Pilih tanda tangan</option>
                @foreach ($signatures as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_pemilik }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>