@php $get_table = \App\Models\Role::where('id', $request['param1'])->first(); @endphp

<div class="card-body p-2">
    <h5 class="mb-4">Update Role</h5>
    <form class="row g-3" method="POST" action="{{ route('roles') }}">
        @csrf
        <div class="col-md-12">
            <label for="role_name" class="form-label">Role Name</label>
            <input type="text" name="role_name" value="{{ $get_table->role_name }}" class="form-control" id="role_name"
                placeholder="Please enter role name" @required(true)>
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-end">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" value="{{ $request['param1'] }}"
                    class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
