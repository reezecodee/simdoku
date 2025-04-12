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

        .custom-table th:first-child,
        .custom-table td:first-child {
            width: 100px;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-3" wire:ignore>
        <div>
            <div id="file-info" class="align-items-center" style="display: none;">
                <img src="/images/excel.svg" width="30" alt="" class="mr-2">
                <span class="mr-2" id="filename"></span>
                <button class="btn btn-sm btn-success mr-2" wire:click="saveExcel">Simpan</button>
                <button class="btn btn-sm btn-danger" wire:click="cancleExcel" id="cancel-upload">Batal</button>
            </div>
            <input type="file" class="d-none" id="upload-excel" wire:model="excelFile" accept=".xlsx, .csv">
        </div>
        <div class="d-flex justify-content-end">
            <form action="{{ route('scholarship.deleteAllStudents', $id) }}" id="delete-student" method="POST"
                class="mr-2">
                @csrf
                @method('DELETE')
                <button type="button" onclick="submitForm('delete-student')" class="btn btn-danger">Hapus
                    Semua</button>
            </form>
            <button class="btn btn-success mr-2" onclick="document.getElementById('upload-excel').click()">Upload
                Excel</button>
            <button class="btn btn-primary" wire:click="createStudent">Tambah Siswa</button>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="table table-striped custom-table">
            <thead>
                <tr>
                    <th>Aksi</th>
                    <th>Nama peserta didik</th>
                    <th>Asal sekolah</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Rangking</th>
                    <th>Besaran beasiswa</th>
                    <th>Status LoA</th>
                    <th>Status SK rektor</th>
                    <th>Status pembayaran</th>
                    <th>Tanggal ajuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $item)
                <tr wire:key="student-{{ $loop->iteration }}">
                    <td>
                        <button class="btn btn-danger" wire:click="deleteStudent('{{ $item->id }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                    <td>
                        <input type="text" class="form-control"
                            wire:input="updateStudent('{{ $item->id }}', 'nama_peserta_didik', $event.target.value)"
                            value="{{ $item->nama_peserta_didik }}">
                    </td>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    const uploadInput = document.getElementById('upload-excel');
    const fileInfo = document.getElementById('file-info');
    const fileName = document.getElementById('filename');
    const cancelButton = document.getElementById('cancel-upload');

    uploadInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            fileName.textContent = file.name;
            fileInfo.style.display = 'flex';
        }
    });

    cancelButton.addEventListener('click', function () {
        uploadInput.value = null;
        fileInfo.style.display = 'none';
    });
</script>