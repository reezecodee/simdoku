<div>
    <style>
        .custom-table th,
        .custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>

    <div wire:loading wire:target="updateVolunteer, updateExecution" class="text-info">
        Menyimpan data...
    </div>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3 mr-2" wire:click="addExecutionVolunteer('{{ $letterId }}')">Tambah
            Pelaksanaan</button>

        @if($executionVolunteers->isEmpty())
        @foreach ($executionVolunteers as $execution)
        <button class="btn btn-primary mb-3" wire:click="addVolunteer({{ $letterId }}, {{ $execution->id }})">
            Tambah Volunteer
        </button>
        @endforeach
        @else
        <select class="form-control w-25" wire:model.defer="selectedExecutionId"
            wire:change="addVolunteerFromDropdown($event.target.value)">
            <option selected>Tambah Volunteer</option>
            @foreach ($executionVolunteers as $execution)
            <option value="{{ $execution->id }}">Tambah volunteer pelaksanaan {{ $loop->iteration }}</option>
            @endforeach
        </select>
        @endif
    </div>

    <table class="table table-striped custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th></th>
                <th>Sekolah</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($executionVolunteers as $execution)
            @php
            $relatedVolunteers = $execution->volunteer;
            @endphp
            <tr>
                <td rowspan="{{ max($relatedVolunteers->count(), 1) }}">{{ $loop->iteration }}</td>
                @if($relatedVolunteers->count() == 0)
                <td colspan="3">Belum ada anggota</td>
                @else
                <td>
                    <input type="number" class="form-control"
                        wire:input="updateVolunteer('{{ $relatedVolunteers->first()->id }}', 'nim', $event.target.value)"
                        value="{{ $relatedVolunteers->first()->nim }}">
                </td>
                <td>
                    <input type="text" class="form-control"
                        wire:input="updateVolunteer('{{ $relatedVolunteers->first()->id }}', 'nama', $event.target.value)"
                        value="{{ $relatedVolunteers->first()->nama }}">
                </td>
                <td>
                    <button class="btn btn-danger" wire:click="deleteVolunteer('{{ $relatedVolunteers->first()->id }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
                @endif
                <td rowspan="{{ max($relatedVolunteers->count(), 1) }}">
                    <input type="text" class="form-control"
                        wire:input="updateExecution('{{ $execution->id }}', 'nama_sekolah', $event.target.value)"
                        value="{{ $execution->nama_sekolah }}">
                </td>
                <td rowspan="{{ max($relatedVolunteers->count(), 1) }}">
                    <input type="date" class="form-control"
                        wire:input="updateExecution('{{ $execution->id }}', 'tgl_pelaksanaan', $event.target.value)"
                        value="{{ $execution->tgl_pelaksanaan }}">
                </td>
                <td rowspan="{{ max($relatedVolunteers->count(), 1) }}">
                    <button class="btn btn-danger" wire:click="deleteExecution('{{ $execution->id }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>

            @if($relatedVolunteers->count() > 1)
            @foreach ($relatedVolunteers->skip(1) as $volunteer)
            <tr wire:key="{{ $volunteer->id }}">
                <td>
                    <input type="number" class="form-control"
                        wire:input="updateVolunteer('{{ $volunteer->id }}', 'nim', $event.target.value)"
                        value="{{ $volunteer->nim }}">
                </td>
                <td>
                    <input type="text" class="form-control"
                        wire:input="updateVolunteer('{{ $volunteer->id }}', 'nama', $event.target.value)"
                        value="{{ $volunteer->nama }}">
                </td>
                <td>
                    <button class="btn btn-danger" wire:click="deleteVolunteer('{{ $volunteer->id }}')">
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