<div>
    @if($$doc->$signature)
    <div class="text-center">
        <div class="d-flex justify-content-center">
            <img width="150"
                src="{{ asset('storage/'.$$doc->$relationName->tanda_tangan) }}"
                alt="" srcset="">
        </div>
        <p class="paragraph-height"><b>{{ $$doc->$relationName->nama_pemilik }}</b></p>
        <p class="paragraph-height"><b>NIP.{{ $$doc->$relationName->nip }}</b></p>
    </div>
    @endif
    <div>
        <div class="d-flex justify-content-center">
            <select class="form-control" wire:change="update{{ $functionName }}('{{ $signature }}', $event.target.value)" id="">
                <option selected>Pilih tanda tangan</option>
                @foreach ($signatures as $item)
                    <option wire:key="{{ $item->id }}" value="{{ $item->id }}">{{ $item->nama_pemilik }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>