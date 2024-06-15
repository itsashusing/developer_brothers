<div class="card-body p-2">
    <h5 class="mb-4">Add Role User</h5>
    <form class="row g-3" method="POST" action="{{ route('role_users') }}">
        @csrf
        <x-roles class="col-md-12" name="role_id" id="role_id" label="Role" value="" defaultSelect="--Please choose role name--" />
        <div class="col-md-12">
            <label for="role_name" class="form-label">User Name</label>
            <input type="text" name="role_name" class="form-control" id="role_name"
                placeholder="Please enter role name" @required(true)>
        </div>
        <div class="col-md-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Please enter email"
                @required(true)>
        </div>
        <div class="col-md-12">
            <label for="mobile" class="form-label">Mobile</label>
            <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Please enter mobile"
                @required(true)>
        </div>
        <div class="col-md-12">
            <label for="password" class="form-label">Password</label>
            <input type="text" name="password" class="form-control" id="password"
                placeholder="Please enter password" @required(true)>
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-end">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
