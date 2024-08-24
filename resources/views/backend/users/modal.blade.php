@php
    $isEdit = isset($user) ? true : false;
    $url = $isEdit ? route('users.update', $user->id) : route('invite.form');
    $roles = \App\Models\Role::all()->toArray();
@endphp

<form action="{{$url}}" method="post" data-form="ajax-form" data-modal="#ajax_model" data-datatable="#users_datatable">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif
    <div class="row">
        <!-- Existing fields... -->

        <!-- Username -->
        <div class="form-group col-lg-6">
            <label for="username">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="username" id="username" value="{{$isEdit ? $user->username : ''}}" required>
        </div>

        <!-- Password (only show for edit, you can choose to show it for create as well if needed) -->
        @if ($isEdit)
        <div class="form-group col-lg-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
            <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
        </div>
        @else
        <div class="form-group col-lg-6">
            <label for="password">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        @endif

        <!-- Access Level -->
        <div class="form-group col-lg-6">
            <label for="access_level">Access Level <span class="text-danger">*</span></label>
            <select class="form-control select2 form-select form-select-modal" name="access_level" id="access_level" required>
                <option value="View" @if ($isEdit && $user->access_level == 'View') selected @endif>View Only</option>
                <option value="Edit" @if ($isEdit && $user->access_level == 'Edit') selected @endif>View and Edit</option>
                <option value="Admin" @if ($isEdit && $user->access_level == 'Admin') selected @endif>Admin Access</option>
            </select>
        </div>

        <!-- Existing fields... -->
        <!-- (Other fields like first_name, last_name, email, etc.) -->

        <div class="col-lg-12 px-0">
            <button type="submit" class="btn btn-primary" data-button="submit">Submit</button>
        </div>
    </div>
</form>
