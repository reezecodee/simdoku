<div>
    <div class="form-group">
        <label for="peserta-kegiatan" class="form-label"><b>2.6 Susunan Acara</b></label>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mb-3" wire:click="addActivity">Tambah Kegiatan</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planSchedules as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <input type="text" wire:input="updateSchedule('{{ $item->id }}', 'nama_kegiatan', $event.target.value)" value="{{ $item->nama_kegiatan }}" class="form-control">
                    </td>
                    <td>
                        <input type="time" wire:input="updateSchedule('{{ $item->id }}', 'waktu', $event.target.value)" value="{{ $item->waktu }}" class="form-control">
                    </td>
                    <td>
                        <button class="btn btn-danger" wire:click="deleteActivity('{{ $item->id }}')"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>