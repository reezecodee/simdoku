<div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3 mr-2" wire:click="addExecutionStaff('{{ $letterId }}')">Tambah
            Pelaksanaan</button>

        @if($executionStaffs->isEmpty())
        @foreach ($executionStaffs as $execution)
        <button class="btn btn-primary mb-3" wire:click="addStaff({{ $letterId }}, {{ $execution->id }})">
            Tambah Staff
        </button>
        @endforeach
        @else
        <select class="form-control w-25" wire:change="addStaffFromDropdown($event.target.value)">
            <option selected>Tambah Staff</option>
            @foreach ($executionStaffs as $execution)
            <option value="{{ $execution->id }}">Tambah staff pelaksanaan {{ $loop->iteration }}</option>
            @endforeach
        </select>
        @endif
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Sekolah</th>
                <th>Tanggal Pelaksanaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($executionStaffs as $execution)
            @php
            $relatedStaffs = $staffs->where('pelaksanaan_id', $execution->id);
            @endphp
            <tr>
                <td rowspan="{{ max($relatedStaffs->count(), 1) + 1 }}">{{ $loop->iteration }}</td>
                <td><input type="text" class="form-control" wire:model.defer="executionStaffs.{{ $loop->index }}.nip">
                </td>
                <td><input type="text" class="form-control" wire:model.defer="executionStaffs.{{ $loop->index }}.nama">
                </td>
                <td rowspan="{{ max($relatedStaffs->count(), 1) + 1 }}">
                    <input type="text" class="form-control" value="{{ $execution->nama_sekolah }}">
                </td>
                <td rowspan="{{ max($relatedStaffs->count(), 1) + 1 }}">
                    <input type="text" class="form-control" value="{{ $execution->tgl_pelaksanaan }}">
                </td>
            </tr>
            @foreach ($relatedStaffs as $staff)
            <tr>
                <td><input type="text" class="form-control" value="{{ $staff->nip }}"></td>
                <td><input type="text" class="form-control" value="{{ $staff->nama }}"></td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>