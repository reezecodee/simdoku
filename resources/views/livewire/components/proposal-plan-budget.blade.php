<div>
    <div class="form-group">
        <label for="rencana-anggaran" class="form-label"><b>2.8 Rencana Anggaran</b></label>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mb-3" wire:click="addBudget">Tambah Rencana Anggaran</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Uraian</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planBudgets as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <input type="text" wire:input="updateBudget('{{ $item->id }}', 'uraian', $event.target.value)" class="form-control">
                    </td>
                    <td>
                        <input type="number" wire:input="updateBudget('{{ $item->id }}', 'jumlah', $event.target.value)" class="form-control">
                    </td>
                    <td>
                        <input type="number" wire:input="updateBudget('{{ $item->id }}', 'total', $event.target.value)" class="form-control">
                    </td>
                    <td>
                        <button class="btn btn-danger" wire:click="deleteBudget('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">Jumlah Pengeluaran:</td>
                    <td>
                        <span id="totalTotal">{{ $total }}</span>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
