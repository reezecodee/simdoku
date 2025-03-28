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
                    <tr wire:key="{{ $item->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <input type="text"
                                wire:input="updateCommittee('{{ $item->id }}', 'nama', $event.target.value)"
                                class="form-control" value="{{ $item->nama }}">
                        </td>
                        <td>
                            <select class="form-control"
                                wire:change="updateCommittee('{{ $item->id }}', 'peran', $event.target.value)">
                                <option value="" {{ !$item->peran ? 'selected' : '' }}>Pilih peran</option>
                                <option value="Pelindung" {{ $item->peran == 'Pelindung' ? 'selected' : '' }}>Pelindung
                                </option>
                                <option value="Penanggung jawab" {{ $item->peran == 'Penanggung jawab' ? 'selected' : ''
                                    }}>Penanggung jawab</option>
                                <option value="Ketua pelaksana" {{ $item->peran == 'Ketua pelaksana' ? 'selected' : ''
                                    }}>Ketua pelaksana</option>
                                <option value="Sekertaris" {{ $item->peran == 'Sekertaris' ? 'selected' : ''
                                    }}>Sekertaris</option>
                                <option value="Bendahara" {{ $item->peran == 'Bendahara' ? 'selected' : '' }}>Bendahara
                                </option>
                                <option value="Seksi acara" {{ $item->peran == 'Seksi acara' ? 'selected' : '' }}>Seksi
                                    acara</option>
                                <option value="Divisi humas" {{ $item->peran == 'Divisi humas' ? 'selected' : ''
                                    }}>Divisi humas</option>
                                <option value="Seksi pudekdok" {{ $item->peran == 'Seksi pudekdok' ? 'selected' : ''
                                    }}>Seksi pudekdok</option>
                                <option value="Koordinator lapangan" {{ $item->peran == 'Koordinator lapangan' ?
                                    'selected' : '' }}>Koordinator lapangan</option>
                            </select>

                        </td>
                        <td>
                            <button class="btn btn-danger" wire:click="deleteCommittee('{{ $item->id }}')"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>