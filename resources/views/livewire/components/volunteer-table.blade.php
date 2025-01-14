<div>
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
        <select class="form-control w-25" wire:change="addVolunteerFromDropdown($event.target.value)">
            <option selected>Tambah Volunteer</option>
            @foreach ($executionVolunteers as $execution)
            <option value="{{ $execution->id }}">Tambah volunteer pelaksanaan {{ $loop->iteration }}</option>
            @endforeach
        </select>
        @endif
    </div>
    <table class="table table-striped">
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
            $relatedVolunteers = $volunteers->where('pelaksanaan_id', $execution->id);
            @endphp
            <tr>
                <td rowspan="{{ max($relatedVolunteers->count(), 1) + 1 }}">{{ $loop->iteration }}</td>
                <td><input type="text" class="form-control"
                        wire:model.defer="executionVolunteers.{{ $loop->index }}.nim">
                </td>
                <td><input type="text" class="form-control"
                        wire:model.defer="executionVolunteers.{{ $loop->index }}.nama">
                </td>
                <td>
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </td>
                <td rowspan="{{ max($relatedVolunteers->count(), 1) + 1 }}">
                    <input type="text" class="form-control" value="{{ $execution->nama_sekolah }}">
                </td>
                <td rowspan="{{ max($relatedVolunteers->count(), 1) + 1 }}">
                    <input type="text" class="form-control" value="{{ $execution->tgl_pelaksanaan }}">
                </td>
                <td rowspan="{{ max($relatedVolunteers->count(), 1) + 1 }}">
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            @foreach ($relatedVolunteers as $volunteer)
            <tr>
                <td>
                    <input type="text" class="form-control" value="{{ $volunteer->nim }}">
                </td>
                <td>
                    <input type="text" class="form-control" value="{{ $volunteer->nama }}">
                </td>
                <td>
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>