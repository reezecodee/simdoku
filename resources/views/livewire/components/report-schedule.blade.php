<div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3" wire:click="createSchedule">Tambah Acara</button>
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
            @foreach($schedules as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <input type="text" wire:input="updateSchedule('{{ $item->id }}', 'waktu', $event.target.value)"
                        value="{{ $item->waktu }}" class="form-control">
                </td>
                <td>
                    <input type="text" wire:input="updateSchedule('{{ $item->id }}', 'sub_acara', $event.target.value)"
                        value="{{ $item->sub_acara }}" class="form-control">
                </td>
                <td>
                    <input type="text" wire:input="updateSchedule('{{ $item->id }}', 'keterangan', $event.target.value)"
                        value="{{ $item->keterangan }}" class="form-control">
                </td>
                <td>
                    <button class="btn btn-danger" wire:click="deleteSchedule('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
