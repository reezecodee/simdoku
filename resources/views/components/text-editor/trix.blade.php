<div>  
    <input id="{{ $title }}" type="hidden" wire:model.lazy="{{ $title }}" name="{{ $title }}" value="{!! $value !!}">
    <trix-editor input="{{ $title }}"></trix-editor>   
</div>
<script>
    var trixEditor = document.getElementById("{{ $title }}")

    addEventListener("trix-blur", function(event) {
        @this.set('{{ $title }}', trixEditor.getAttribute('value'))
    })
</script>