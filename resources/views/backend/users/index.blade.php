@extends('backend.layouts.app')

@section('title', '| Users')

@section('breadcrumb')
    <div class="page-header">
        <h1 class="page-title">Accounts List</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Accounts</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header justify-content-between">
            <h3 class="card-title font-weight-bold">Accounts</h3>
            @can('add_user')
                <button type="button" class="btn dark-icon btn-primary" data-act="ajax-modal" data-method="get"
                    data-action-url="{{ route('users.create') }}" data-title="Add New User">
                    <i class="ri-add-fill"></i> Add User
                </button>
            @endcan
        </div>
        <div class="card-body">
            
                <form method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="access">Access Level:</label>
                        <select class="form-control" id="access" name="access">
                            <option value="View">View Only</option>
                            <option value="Edit">View and Edit</option>
                            <option value="Admin">Admin Access</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </form>
            <div id="modal-container">
                <!-- Modal content will be loaded here -->
            </div>
            
            <div class="table-responsive">
                <table id="users_datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">First Name</th>
                            <th class="border-bottom-0">Access Level</th>
                            <th class="border-bottom-0">Action</th>
                          
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            @include('backend.users.form')

        </div>
    </div>
@endsection

@push('scripts')
    <script>
     $(function() {
    $('#users_datatable').DataTable({
        ajax: '{{ route('users-datatable') }}',
        processing: true,
        serverSide: true,
        scrollX: false,
        searching:false,
        autoWidth: true,
        columnDefs: [{
                width: 0,
                targets: 1
            },
            {
                width: '2%',
                targets: 0
            },
            {
                orderable: false, // Disable sorting for the action column
                targets: -1 // Targets the last column
            }
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'id'
            },
            {
                data: 'first_name',
                name: 'first_name'
            },
            {
                data: 'access_level',
                name: 'access_level'
            },
            {
                data: 'action',
                name: 'action',
                        render: function(data, type, row) {
                            let editUrl = `{{ url('users/:id/edit') }}`.replace(':id', row.id);
    
    return `<button type="button" class="btn btn-warning btn-sm edit-btn" 
                    data-id="${row.id}" 
                    data-act="ajax-modal" 
                    data-method="get" 
                    data-action-url="${editUrl}" 
                    data-title="Edit User">
                Edit
            </button>`;
}
            }
        ]
    });
    

});

    </script>
@endpush
