<div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3">Tambah Acara</button>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Sub Acara</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>
                    <input type="text" wire:model.lazy="" class="form-control">
                </td>
                <td>
                    <input type="text" wire:model.lazy="" class="form-control">
                </td>
                <td>
                    <input type="text" wire:model.lazy="" class="form-control">
                </td>
                <td>
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
