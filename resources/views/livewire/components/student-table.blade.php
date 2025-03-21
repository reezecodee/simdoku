<div>
    <style>
        .custom-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .custom-table th,
        .custom-table td {
            border: 1px solid #ddd;
            width: 200px;
        }
    </style>

    <div class="d-flex justify-content-end">
        <button class="btn btn-success mb-3 mr-2" wire:click="uploadExcel">Upload Excel</button>
        <button class="btn btn-primary mb-3" wire:click="createStudent">Tambah Siswa</button>
    </div>

    <div style="overflow-x: auto;">
        <table class="table table-striped custom-table">
            <thead>
                <tr>
                    <th>Asal sekolah</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Nama peserta didik</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Rangking</th>
                    <th>Besaran beasiswa</th>
                    <th>Status loA</th>
                    <th>Status SK rektor</th>
                    <th>Status pembayaran</th>
                    <th>Tanggal ajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $item)
                <tr wire:key="student-{{ $loop->iteration }}">
                    <td>
                        <input type="text" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'asal_sekolah', $event.target.value)"
                            value="{{ $item->asal_sekolah }}">
                    </td>
                    <td>
                        <input type="number" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'nis', $event.target.value)"
                            value="{{ $item->nis }}">
                    </td>
                    <td>
                        <input type="number" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'nisn', $event.target.value)"
                            value="{{ $item->nisn }}">
                    </td>
                    <td>
                        <input type="text" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'nama_peserta_didik', $event.target.value)"
                            value="{{ $item->nama_peserta_didik }}">
                    </td>
                    <td>
                        <select class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'kelas', $event.target.value)">
                            @if($item->kelas)
                            <option value="{{ $item->kelas }}" selected>{{ $item->kelas }}</option>
                            @else
                            <option selected>Pilih kelas</option>
                            @endif
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                            <option value="XIII">XIII</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'jurusan', $event.target.value)"
                            value="{{ $item->jurusan }}">
                    </td>
                    <td>
                        <select class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'rangking', $event.target.value)">
                            @if($item->rangking)
                            <option value="{{ $item->rangking }}" selected>{{ $item->rangking }}</option>
                            @else
                            <option selected>Pilih rangking</option>
                            @endif
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'besaran_beasiswa', $event.target.value)"
                            value="{{ $item->besaran_beasiswa }}">
                    </td>
                    <td>
                        <input type="text" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'status_loa', $event.target.value)"
                            value="{{ $item->status_loa }}">
                    </td>
                    <td>
                        <input type="text" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'status_sk_rektor', $event.target.value)"
                            value="{{ $item->status_sk_rektor }}">
                    </td>
                    <td>
                        <input type="text" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'status_pembayaran', $event.target.value)"
                            value="{{ $item->status_pembayaran }}">
                    </td>
                    <td>
                        <input type="date" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'tgl_ajuan', $event.target.value)"
                            value="{{ $item->tgl_ajuan }}">
                    </td>
                    <td>
                        <button class="btn btn-danger" wire:click="deleteStudent('{{ $item->id }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>