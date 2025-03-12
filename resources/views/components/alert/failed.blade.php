@if(session('failed'))
<div class="alert alert-warning" role="alert" id="alert">
    {{ session('failed') }}
</div>

<script>
    setTimeout(function() {
        let alert = document.getElementById('alert');
        alert.style.display = "none";
    }, 4000);
</script>
@endif