<div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <button wire:click="downloadPDF" class="btn btn-success mr-2">Download PDF</button>
                    <a href="{{ route('letter.assignment') }}" wire:navigate.hover>
                        <button class="btn btn-danger">Kembali</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
