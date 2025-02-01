<div>
    <div wire:ignore>
        <input id="{{ $title }}" type="hidden" wire:model.lazy="{{ $title }}" name="{{ $title }}" value="{!! $value !!}">
        <trix-editor input="{{ $title }}"></trix-editor>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let trixEditor = document.querySelector('trix-editor[input="{{ $title }}"]');
        
        trixEditor.addEventListener("trix-change", function () {
            @this.set('{{ $title }}', trixEditor.value);
        });
    });
</script>
