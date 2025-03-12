<div>
    <div class="form-group">
        <label for="susunan-panitia" class="form-label"><b>2.7 Susunan Panitia</b></label>
        <div class="form-group">
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary mb-3" wire:click="addCommittee">Tambah Panitia</button>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Panitia</th>
                        <th>Peran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planCommittees as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <input type="text" wire:input="updateCommittee('{{ $item->id }}', 'nama', $event.target.value)" class="form-control">
                        </td>
                        <td>
                            <select class="form-control" wire:input="updateCommittee('{{ $item->id }}', 'peran', $event.target.value)">
                                <option selected>Pilih peran</option>
                                <option value="Pelindung">Pelindung</option>
                                <option value="Penanggung jawab">Penanggung jawab</option>
                                <option value="Ketua pelaksana">Ketua pelaksana</option>
                                <option value="Sekertaris">Sekertaris</option>
                                <option value="Bendahara">Bendahara</option>
                                <option value="Seksi acara">Seksi acara</option>
                                <option value="Divisi humas">Divisi humas</option>
                                <option value="Seksi pudekdok">Seksi pudekdok</option>
                                <option value="Koordinator lapangan">Koordinator lapangan</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger" wire:click="deleteCommittee('{{ $item->id }}')"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>