<div>
    <style>
        .custom-table th,
        .custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>

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
        <select class="form-control w-25" wire:model.defer="selectedExecutionId"
            wire:change="addStaffFromDropdown($event.target.value)">
            <option selected>Tambah Staff</option>
            @foreach ($executionStaffs as $execution)
            <option value="{{ $execution->id }}">Tambah staff pelaksanaan {{ $loop->iteration }}</option>
            @endforeach
        </select>
        @endif
    </div>

    <table class="table table-striped custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th></th>
                <th>Sekolah</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($executionStaffs as $execution)
            @php
            $relatedStaffs = $execution->staff;
            @endphp
            <tr>
                <td rowspan="{{ max($relatedStaffs->count(), 1) }}">{{ $loop->iteration }}</td>
                @if($relatedStaffs->count() == 0)
                <td colspan="3">Belum ada anggota</td>
                @else
                <td>
                    <input type="text" class="form-control" value="{{ $relatedStaffs->first()->nip }}">
                </td>
                <td>
                    <input type="text" class="form-control" value="{{ $relatedStaffs->first()->nama }}">
                </td>
                <td>
                    <button class="btn btn-danger" wire:click="deleteStaff('{{ $relatedStaffs->first()->id }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
                @endif
                <td rowspan="{{ max($relatedStaffs->count(), 1) }}">
                    <input type="text" class="form-control" value="{{ $execution->nama_sekolah }}">
                </td>
                <td rowspan="{{ max($relatedStaffs->count(), 1) }}">
                    <input type="text" class="form-control" value="{{ $execution->tgl_pelaksanaan }}">
                </td>
                <td rowspan="{{ max($relatedStaffs->count(), 1) }}">
                    <button class="btn btn-danger" wire:click="deleteExecution('{{ $execution->id }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>

            @if($relatedStaffs->count() > 1)
            @foreach ($relatedStaffs->skip(1) as $staff)
            <tr>
                <td>
                    <input type="text" class="form-control" value="{{ $staff->nip }}">
                </td>
                <td>
                    <input type="text" class="form-control" value="{{ $staff->nama }}">
                </td>
                <td>
                    <button class="btn btn-danger" wire:click="deleteStaff('{{ $staff->id }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
            @endforeach
        </tbody>
    </table>

</div>
</div>