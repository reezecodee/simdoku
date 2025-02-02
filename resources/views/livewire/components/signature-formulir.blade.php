<div>
    @if($formulir->$signature)
    <div>
        <p class="text-center">{{ $as }},</p>
        <p class="text-center">{{ $position }}</p>
        <div class="d-flex justify-content-center">
            <div style="height: 87px"></div>
        </div>
        <p class="paragraph-height text-center">({{ $formulir->$relation->nama_pemilik }})</p>
    </div>
    @endif
    <div>
        <div class="d-flex justify-content-center">
            <select class="form-control" wire:change="update{{ $functionName }}('{{ $signature }}', $event.target.value)" id="">
                <option selected>Pilih tanda tangan</option>
                @foreach ($signatures as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_pemilik }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
