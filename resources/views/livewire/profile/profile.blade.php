<div>
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="submit('{{ $user->id }}')">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="form-label">Nama pengguna</label>
                            <input type="text" wire:model.lazy="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Masukkan nama pengguna">
                            @error('nama')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="form-label">Nomor Induk Pegawai NIP</label>
                            <input type="text" wire:model.lazy="nip"
                                class="form-control @error('nip') is-invalid @enderror"
                                placeholder="Masukkan nomor NIP">
                            @error('nip')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="form-label">Nomor Induk Pegawai NIP</label>
                            <div class="d-flex justify-content-center mb-2">
                                @if($user->tanda_tangan)
                                <div>
                                    @if(!$tanda_tangan)
                                    <img src="{{ asset('storage/'.$user->tanda_tangan) }}" width="150" alt="" srcset=""
                                    class="d-block">
                                    @else
                                    <span class="text-center d-block">{{ $tanda_tangan->getClientOriginalName() }} <br> ({{
                                        $tanda_tangan->getSize() / 1024
                                        }}
                                        KB)</span>
                                    @endif
                                </div>
                                @else
                                @if($tanda_tangan)
                                <span class="text-center">{{ $tanda_tangan->getClientOriginalName() }} <br> ({{
                                    $tanda_tangan->getSize() / 1024
                                    }}
                                    KB)</span>
                                @else
                                <span>Belum ada tanda tangan</span>
                                @endif
                                @endif
                            </div>
                            <label for="fileInput" class="form-label btn btn-primary px-4 py-2 text-white">
                                Pilih File
                            </label>
                            <input type="file" id="fileInput" wire:model.lazy="tanda_tangan" style="display: none"
                                class="form-control @error('tanda_tangan') is-invalid @enderror" accept=".jpg, .png">
                            @error('tanda_tangan')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>