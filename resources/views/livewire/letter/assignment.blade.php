<div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a wire:click="createLetterAssigment">
                        <button class="btn btn-primary">Buat Surat Tugas</button>
                    </a>
                </div>
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Perihal</th>
                            <th>Acara</th>
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
                    ajax: '{{ route('letter.list') }}', 
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, 
                        { data: 'perihal', name: 'perihal' }, 
                        { data: 'nama_acara', name: 'nama_acara' }, 
                        { data: 'action', name: 'action', orderable: false, searchable: false } 
                    ]
                });
            });
        </script>
    </x-slot>
</div>