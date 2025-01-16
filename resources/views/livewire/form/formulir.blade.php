<div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a>
                        <button wire:click="createFormulir" class="btn btn-primary">Buat Formulir Pengajuan</button>
                    </a>
                </div>
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal pengajuan</th>
                            <th>Tanggal diperlukan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable({
                    processing: true,       
                    serverSide: true,      
                    ajax: '{{ route('form.list') }}', 
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, 
                        { data: 'judul', name: 'judul' }, 
                        { data: 'tgl_pengajuan', name: 'tgl_pengajuan' }, 
                        { data: 'tgl_diperlukan', name: 'tgl_diperlukan' }, 
                        { data: 'action', name: 'action', orderable: false, searchable: false } 
                    ]
                });
            });
        </script>
    </x-slot>
</div>
