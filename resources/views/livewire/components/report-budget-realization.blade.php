<div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3" wire:click="createBudget">Tambah Anggaran</button>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Anggaran</th>
                <th>Jumlah</th>
                <th>(Rupiah)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($budgets as $item)
            <tr wire:key="{{ $item->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>
                    <input type="text" wire:input="updateBudget('{{ $item->id }}', 'anggaran', $event.target.value)" value="{{ $item->anggaran }}" class="form-control">
                </td>
                <td>
                    <input type="text" wire:input="updateBudget('{{ $item->id }}', 'jumlah', $event.target.value)" value="{{ $item->jumlah }}" class="form-control">
                </td>
                <td>
                    <input type="text" wire:input="updateBudget('{{ $item->id }}', 'rupiah', $event.target.value)" value="{{ $item->rupiah }}" class="form-control">
                </td>
                <td>
                    <button class="btn btn-danger" wire:click="deleteBudget('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: center; font-style: italic; font-weight: bold">Total Pengeluaran</td>
                <td colspan="2" style="font-weight: bold">{{ idr($budgets->sum('rupiah')) }}</td>
            </tr>
        </tbody>
    </table>
</div>