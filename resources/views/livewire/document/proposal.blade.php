<div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a wire:click="createProposal">
                        <button class="btn btn-primary">Buat Proposal</button>
                    </a>
                </div>
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
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
                    ajax: '{{ route('proposal.list') }}', 
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, 
                        { data: 'judul', name: 'judul' }, 
                        { data: 'action', name: 'action', orderable: false, searchable: false } 
                    ]
                });
            });
        </script>
    </x-slot>
</div>
