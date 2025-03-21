<div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a>
                        <button wire:click="createFormulir" class="btn btn-primary">Tambah Penerima Beasiswa</button>
                    </a>
                </div>
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Beasiswa</th>
                            <th>Tahun</th>
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
                    ajax: '{{ route('scholarship.list') }}', 
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, 
                        { data: 'nama', name: 'nama' }, 
                        { data: 'tahun', name: 'tahun' }, 
                        { data: 'action', name: 'action', orderable: false, searchable: false } 
                    ]
                });
            });
        </script>
    </x-slot>
</div>
