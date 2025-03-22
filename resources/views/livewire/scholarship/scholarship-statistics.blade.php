<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('scholarship.modify', $id) }}" wire:navigate.hover>
                    <button class="btn btn-danger">Kembali</button>
                </a>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mr-2" wire:click="downloadAll">Download Semua</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Pengguna</p>
                            <img src="/charts/pie.png" alt="" srcset="">
                            <button class="btn btn-primary">Download</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p>Statistik Pengguna</p>
                            <img src="/charts/pie.png" alt="" srcset="">
                            <button class="btn btn-primary">Download</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>