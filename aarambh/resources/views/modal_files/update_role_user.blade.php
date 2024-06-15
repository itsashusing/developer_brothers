@php $get_table = \App\Models\Role_users::where('id', $request['param1'])->first(); @endphp

<div class="card-body p-2">
    <h5 class="mb-4">Update Role User</h5>
    <form class="row g-3" method="POST" action="{{ route('role_users') }}">
        @csrf
        <x-roles class="col-md-12" name="role_id" id="role_id" label="Role" value="{{ $get_table->role_id }}"
            defaultSelect="--Please choose role name--" />
        <div class="col-md-12">
            <label for="role_name" class="form-label">Role Name</label>
            <input type="text" name="role_name" value="{{ $get_table->name }}" class="form-control" id="role_name"
                placeholder="Please enter role name" @required(true)>
        </div>
        <div class="col-md-12">
            <label for="email" class="form-label">Eamil</label>
            <input type="email" name="email" value="{{ $get_table->email }}" class="form-control" id="email"
                placeholder="Please enter email" @required(true)>
        </div>
        <div class="col-md-12">
            <label for="mobile" class="form-label">Mobile</label>
            <input type="text" name="mobile" value="{{ $get_table->mobile }}" class="form-control" id="mobile"
                placeholder="Please enter mobile" @required(true)>
        </div>
        <div class="col-md-12">
            <label for="password" class="form-label">Password</label>
            <input type="text" name="password" class="form-control" id="password"
                placeholder="Please enter password">
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-end">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" value="{{ $request['param1'] }}"
                    class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
