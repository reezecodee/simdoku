@if(session('success'))
<div class="alert alert-success" role="alert" id="alert">
    {{ session('success') }}
</div>

<script>
    setTimeout(function() {
        let alert = document.getElementById('alert');
        alert.style.display = "none";
    }, 4000);
</script>
@endif